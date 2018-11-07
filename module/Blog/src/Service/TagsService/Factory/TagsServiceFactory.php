<?php


namespace Blog\Service\TagsService\Factory;


use Blog\Service\TagsService\TagsService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TagsServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TagsService();
    }
}