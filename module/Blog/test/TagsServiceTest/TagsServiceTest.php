<?php

namespace TagsServiceTest;

use Blog\Service\TagsService\TagsService;
use Zend\ServiceManager\ServiceManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class TagsServiceTest extends AbstractHttpControllerTestCase
{
    public function testTagsInContentWillBeChangeToExpectedData()
    {
        $tagsService = new TagsService();
        $postTitle = 'Example Title';
        $tag = '{POST_TITLE}';
        $content = 'This is example post with {POST_TITLE} title';
        $expectedContent = 'This is example post with Example Title title';

        $result = $tagsService->convert([
            $tag => $postTitle
        ], $content);

        $this->assertSame($expectedContent, $result);
    }
}