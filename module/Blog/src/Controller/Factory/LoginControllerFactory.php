<?php


namespace Blog\Controller\Factory;


use Blog\Controller\LoginController;
use Blog\Form\LoginForm;
use Blog\Service\UserAuthService\UserAuthServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Model\ViewModel;

class LoginControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new LoginController(
            new ViewModel(),
            new LoginForm(),
            $container->get(UserAuthServiceInterface::class)
        );
    }
}