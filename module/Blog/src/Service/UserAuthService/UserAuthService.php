<?php


namespace Blog\Service\UserAuthService;


use Blog\Entity\UserAuthEntity;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Hydrator\Reflection;

class UserAuthService implements UserAuthServiceInterface
{
    private $authenticationService;
    private $hydrator;
    private $userAuthEntity;

    public function __construct(AuthenticationService $authenticationService, Reflection $hydrator, UserAuthEntity $userAuthEntity)
    {
        $this->authenticationService = $authenticationService;
        $this->hydrator = $hydrator;
        $this->userAuthEntity = $userAuthEntity;
    }

    public function authenticate(string $username, string $password)
    {
        /* @var $userAuthEntity UserAuthEntity */
        $userAuthEntity = $this->hydrator->hydrate(['username' => $username, 'password' => $password], clone $this->userAuthEntity);
        /* @var $adapter \Blog\Adapter\AuthAdapter */
        $adapter = $this->authenticationService->getAdapter();
        $adapter->setUserAuthEntity($userAuthEntity);
        $result = $adapter->authenticate();

        if($result->getCode() !== Result::SUCCESS)
        {
            throw new \Exception($result->getMessages()[0]);
        }

    }
}