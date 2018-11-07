<?php


namespace Blog\Repository\PostRepository;


use Blog\Entity\PostEntity;
use Doctrine\ORM\EntityManagerInterface;

class PostDoctrineRepository implements PostDoctrineRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findPostByCurrentUserAndId($id, $userId)
    {
        return $this->entityManager->getRepository(PostEntity::class)->findBy([
            'user' => $userId,
            'id' => $id
        ])[0];
    }

    public function findAllPosts(): array
    {
        return $this->entityManager->getRepository(PostEntity::class)->findAll();
    }

    public function findPostByCurrentUser($id)
    {
        return $this->entityManager->getRepository(PostEntity::class)->findBy(
            [
                'user' => $id
            ],
            [
                'createdDate' => 'DESC'
            ]);
    }

    public function findPostByActive()
    {
        return $this->entityManager->getRepository(PostEntity::class)->findBy(
            [
                'active' => true
            ],
            [
                'createdDate' => 'DESC'
            ]);
    }

    public function findPostById($id)
    {
        return $this->entityManager->getRepository(PostEntity::class)->findBy([
            'id' => $id
        ])[0];
    }

    public function createOrUpdatePost(PostEntity $postEntity): void
    {
        $entityManager = clone $this->entityManager;
        $entityManager->persist($postEntity);
        $entityManager->flush();
    }
}