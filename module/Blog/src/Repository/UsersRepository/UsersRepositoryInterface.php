<?php


namespace Blog\Repository\UsersRepository;


interface UsersRepositoryInterface
{
    public function findBy(array $criteria);
}