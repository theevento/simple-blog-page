<?php


namespace Blog\Repository\PostRepository\Factory;


use Blog\Repository\PostRepository\PostDoctrineRepository;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\Reflection;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostDoctrineRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PostDoctrineRepository(
            $container->get('doctrine.entitymanager.orm_default')
        );
    }
}