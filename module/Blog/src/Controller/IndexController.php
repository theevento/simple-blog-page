<?php

namespace Blog\Controller;

use Blog\Service\PostService\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $postService;
    private $viewModel;

    public function __construct(PostServiceInterface $postService, ViewModel $viewModel)
    {
        $this->postService = $postService;
        $this->viewModel = $viewModel;
    }

    public function indexAction()
    {
        $posts = $this->postService->findPostByActive();
        $viewModel = clone $this->viewModel;
        $viewModel->setVariable('posts', $posts);
        return $viewModel;
    }

    public function postAction()
    {
        $viewModel = clone $this->viewModel;
        $id = $this->params()->fromRoute('id', null);
        $post = $this->postService->findPostById($id);

        if($post === null)
        {
            return $this->notFoundAction();
        }

        $viewModel->setVariable('post', $post);
        return $viewModel;
    }
}
