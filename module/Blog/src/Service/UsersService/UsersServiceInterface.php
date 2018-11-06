<?php


namespace Blog\Service\UsersService;


interface UsersServiceInterface
{
    public function findBy(array $criteria);
}