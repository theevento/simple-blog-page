<?php


namespace Blog\Controller;


use Blog\Entity\PostEntity;
use Blog\Form\PostForm;
use Blog\Service\PostService\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class LoggedController extends AbstractActionController
{
    private $postForm;
    private $viewModel;
    private $postService;

    public function onDispatch(MvcEvent $mvcEvent)
    {
        $response = parent::onDispatch($mvcEvent);
        $this->layout('layout/admin');
        return $response;
    }

    public function __construct(PostForm $postForm, ViewModel $viewModel, PostServiceInterface $postService)
    {
        $this->postForm = $postForm;
        $this->postService = $postService;
        $this->viewModel = $viewModel;
    }

    public function indexAction()
    {
        $posts = $this->postService->findPostByCurrentUser();
        $viewModel = clone $this->viewModel;
        $viewModel->setVariable('posts', $posts);

        return $viewModel;
    }

    public function editAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id', null);
        /* @var $post PostEntity */
        $post = $this->postService->findPostByCurrentUserAndId($id);

        if ($post === null) {
            return $this->notFoundAction();
        }

        $viewModel = clone $this->viewModel;
        $postForm = clone $this->postForm;

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $postForm->setData($data);
            if ($postForm->isValid()) {
                try {
                    $this->postService->createOrUpdatePost($data, $post);
                    $viewModel->setVariable('success', true);
                } catch (\Exception $exception) {
                }
            } else {
                $viewModel->setVariable('messages', $postForm->getMessages());
            }
        }

        $postForm->setData([
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'content' => $post->getContent(),
            'active' => $post->getActive()
        ]);

        $viewModel->setVariable('postForm', $postForm);
        return $viewModel;
    }

    public function addAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $postForm = clone $this->postForm;
        $viewModel = clone $this->viewModel;
        $viewModel->setVariable('postForm', $postForm);

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $postForm->setData($data);
            if ($postForm->isValid()) {
                try {
                    $this->postService->createOrUpdatePost($data);
                    $viewModel->setVariable('success', true);
                    $viewModel->setVariable('postForm', clone $this->postForm);
                } catch (\Exception $exception) {
                }
            } else {
                $viewModel->setVariable('messages', $postForm->getMessages());
            }
        }

        return $viewModel;
    }
}