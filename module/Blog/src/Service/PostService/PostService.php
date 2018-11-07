<?php


namespace Blog\Service\PostService;


use Blog\Entity\PostEntity;
use Blog\Repository\PostRepository\PostRepositoryInterface;
use Blog\Repository\UsersRepository\UsersRepositoryInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Hydrator\Reflection;

class PostService implements PostServiceInterface
{
    private $postRepository;
    private $hydrator;
    private $postEntity;
    private $authenticationService;
    private $userRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        Reflection $hydrator,
        PostEntity $postEntity,
        AuthenticationService $authenticationService,
        UsersRepositoryInterface $userRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->hydrator = $hydrator;
        $this->postEntity = $postEntity;
        $this->authenticationService = $authenticationService;
        $this->userRepository = $userRepository;
    }

    public function findPostByCurrentUserAndId($id)
    {
        $userId = $this->authenticationService->getIdentity();
        return $this->postRepository->findPostByCurrentUserAndId($id, $userId);
    }

    public function findPostByCurrentUser()
    {
        $userId = $this->authenticationService->getIdentity();
        return $this->postRepository->findPostByCurrentUser($userId);
    }

    public function findAllPosts(): array
    {
        return $this->postRepository->findAllPosts();
    }

    public function createOrUpdatePost(array $data, PostEntity $postEntity = null): void
    {
        /* @var $postEntity \Blog\Entity\PostEntity */
        if ($postEntity === null) {
            $userId = $this->authenticationService->getIdentity();
            $user = $this->userRepository->findBy(['id' => $userId])[0];
            $data['user'] = $user;
            $postEntity = $this->hydrator->hydrate($data, clone $this->postEntity);
        } else {
            $postEntity = $this->hydrator->hydrate($data, $postEntity);
        }

        $this->postRepository->createOrUpdatePost($postEntity);
    }
}