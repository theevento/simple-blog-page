<?php


namespace Blog\Service\PostService;


use Blog\Entity\PostEntity;

interface PostServiceInterface
{
    public function findAllPosts(): array;

    public function createOrUpdatePost(array $data, PostEntity $postEntity = null): void;

    public function findPostByCurrentUser();

    public function findPostByCurrentUserAndId($id);
}