<?php


namespace Blog\Controller\Factory;


use Blog\Controller\IndexController;
use Blog\Service\PostService\PostServiceInterface;
use Blog\Service\TagsService\TagsServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Model\ViewModel;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new IndexController(
            $container->get(PostServiceInterface::class),
            new ViewModel(),
            $container->get(TagsServiceInterface::class)
        );
    }
}