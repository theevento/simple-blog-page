<?php


namespace Blog\Service\PostService\Factory;


use Blog\Entity\PostEntity;
use Blog\Repository\PostRepository\PostRepositoryInterface;
use Blog\Repository\UsersRepository\UsersRepositoryInterface;
use Blog\Service\PostService\PostService;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Hydrator\Reflection;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PostService(
            $container->get(PostRepositoryInterface::class),
            new Reflection(),
            new PostEntity(),
            $container->get(AuthenticationService::class),
            $container->get(UsersRepositoryInterface::class)
        );
    }
}