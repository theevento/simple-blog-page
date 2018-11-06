<?php


namespace Blog\Repository\UsersRepository\Factory;


use Blog\Repository\UsersRepository\UsersDoctrineRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UsersDoctrineRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UsersDoctrineRepository(
            $container->get('doctrine.entitymanager.orm_default')
        );
    }
}