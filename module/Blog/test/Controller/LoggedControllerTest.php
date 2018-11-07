<?php


namespace BlogTest\Controller;


use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class LoggedControllerTest extends AbstractHttpControllerTestCase
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

    public function testIndexActionIfUserIsUnauthenticated()
    {
        $this->dispatch('/logged');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/login');
    }
}