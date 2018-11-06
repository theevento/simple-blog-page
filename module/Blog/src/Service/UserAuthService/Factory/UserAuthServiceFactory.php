<?php


namespace Blog\Service\UserAuthService\Factory;


use Blog\Entity\UserAuthEntity;
use Blog\Service\UserAuthService\UserAuthService;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Hydrator\Reflection;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserAuthServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UserAuthService(
            $container->get(AuthenticationService::class),
            new Reflection(),
            new UserAuthEntity()
        );
    }
}