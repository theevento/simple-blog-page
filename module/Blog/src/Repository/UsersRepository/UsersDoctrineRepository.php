<?php


namespace Blog\Repository\UsersRepository;


use Blog\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;

class UsersDoctrineRepository implements UsersDoctrineRepositoryRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findBy(array $criteria)
    {
        return $this->entityManager->getRepository(UserEntity::class)->findBy($criteria);
    }
}