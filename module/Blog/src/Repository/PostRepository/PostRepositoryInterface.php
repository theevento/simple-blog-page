<?php


namespace Blog\Repository\PostRepository;


use Blog\Entity\PostEntity;

interface PostRepositoryInterface
{
    public function findAllPosts(): array;

    public function createOrUpdatePost(PostEntity $postEntity): void;

    public function findPostByCurrentUser($id);

    public function findPostByCurrentUserAndId($id, $userId);

    public function findPostByActive();

    public function findPostById($id);
}