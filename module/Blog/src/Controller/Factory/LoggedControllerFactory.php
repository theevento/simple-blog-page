<?php


namespace Blog\Controller\Factory;


use Blog\Controller\LoggedController;
use Blog\Form\PostForm;
use Blog\Service\PostService\PostServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Model\ViewModel;

class LoggedControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new LoggedController(
            new PostForm(),
            new ViewModel(),
            $container->get(PostServiceInterface::class)
        );
    }
}