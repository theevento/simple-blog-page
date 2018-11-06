<?php


namespace Blog\Service\UserAuthService;


interface UserAuthServiceInterface
{
    public function authenticate(string $username, string $password);
}