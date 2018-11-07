<?php


namespace Blog\Controller;


use Blog\Form\LoginForm;
use Blog\Service\UserAuthService\UserAuthServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    private $loginForm;
    private $viewModel;
    private $authenticationService;

    public function __construct(ViewModel $viewModel, LoginForm $loginForm, UserAuthServiceInterface $authService)
    {
        $this->viewModel = $viewModel;
        $this->loginForm = $loginForm;
        $this->authenticationService = $authService;
    }

    public function indexAction()
    {
        $this->layout()->setTemplate('layout/login');
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $authenticationService = clone $this->authenticationService;
        $loginForm = clone $this->loginForm;
        $viewModel = clone $this->viewModel;
        $viewModel->setVariable('loginForm', $loginForm);

        if ($request->isPost()) {
            $data = $request->getPost();
            $loginForm->setData($data);
            if ($loginForm->isValid()) {
                try {
                    $authenticationService->authenticate($data['login'], $data['password']);
                    $this->redirect()->toRoute('logged');
                } catch (\Exception $exception) {
                    $viewModel->setVariable('authErrors', $exception->getMessage());
                }
            } else {
                $viewModel->setVariable('messages', $loginForm->getMessages());
            }
        }

        return $viewModel;
    }

    public function logoutAction()
    {
        $this->authenticationService->logout();
        return $this->redirect()->toRoute('login');
    }
}