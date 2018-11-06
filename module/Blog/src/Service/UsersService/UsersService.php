<?php


namespace Blog\Service\UsersService;


use Blog\Repository\UsersRepository\UsersRepositoryInterface;

class UsersService implements UsersServiceInterface
{
    private $userRepository;

    public function __construct(UsersRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findBy(array $criteria)
    {
        return $this->userRepository->findBy($criteria);
    }
}