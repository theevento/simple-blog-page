<?php


namespace Blog\Service\UsersService\Factory;


use Blog\Repository\UsersRepository\UsersRepositoryInterface;
use Blog\Service\UsersService\UsersService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UsersServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UsersService(
            $container->get(UsersRepositoryInterface::class)
        );
    }
}