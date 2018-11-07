<?php


namespace BlogTest\Controller;


use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testPostActionIfPostIsNotExistInDatabase()
    {
        $this->dispatch('/blog/-1');
        $this->assertResponseStatusCode(404);
    }
}