<?php


namespace Blog\Adapter;


use Blog\Entity\UserAuthEntity;
use Blog\Service\UsersService\UsersServiceInterface;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

class AuthAdapter implements AdapterInterface
{
    private $usersService;
    private $bcrypt;
    private $userAuthEntity;

    public function __construct(UsersServiceInterface $usersService, Bcrypt $bcrypt)
    {
        $this->usersService = $usersService;
        $this->bcrypt = $bcrypt;
    }

    /**
     * @param UserAuthEntity $userAuthEntity
     */
    public function setUserAuthEntity(UserAuthEntity $userAuthEntity): void
    {
        $this->userAuthEntity = $userAuthEntity;
    }

    public function authenticate()
    {
        $bcrypt = clone $this->bcrypt;
        /* @var $userAuthEntity \Blog\Entity\UserAuthEntity */
        $userAuthEntity = $this->userAuthEntity;
        /* @var $user \Blog\Entity\UserEntity */
        $user = $this->usersService->findBy(['userName' => $userAuthEntity->getUsername()])[0];

        if (!$user) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid username or password']
            );
        }

        if ($user->getActive() === false) {
            return new Result(
                Result::FAILURE,
                null,
                ['User is deactive']
            );
        }

        if(!$bcrypt->verify($userAuthEntity->getPassword(), $user->getPassword()))
        {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid username or password']
            );
        }

        return new Result(
            Result::SUCCESS,
            $user->getId(),
            []
        );
    }


}