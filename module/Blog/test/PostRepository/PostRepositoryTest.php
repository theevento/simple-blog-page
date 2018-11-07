<?php


namespace BlogTest\PostRepository;


use Blog\Repository\PostRepository\PostRepositoryInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class PostRepositoryTest extends AbstractHttpControllerTestCase
{
    protected $postRepository;

    public function setUp()
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();

        $this->configureServiceManager($this->getApplicationServiceLocator());
    }

    protected function configureServiceManager(ServiceManager $services)
    {
        $services->setAllowOverride(true);

        $this->postRepository = $services->get(PostRepositoryInterface::class);

        $services->setAllowOverride(false);
    }


    public function testFindNotExistingPostByPostRepository()
    {
        $post = $this->postRepository->findPostById(-1);
        $this->assertNull($post);
    }
}