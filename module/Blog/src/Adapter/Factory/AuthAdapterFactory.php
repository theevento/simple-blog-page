<?php


namespace Blog\Adapter\Factory;


use Blog\Adapter\AuthAdapter;
use Blog\Service\UsersService\UsersServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AuthAdapter(
            $container->get(UsersServiceInterface::class),
            new Bcrypt()
        );
    }
}