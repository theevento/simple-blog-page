<?php


namespace Blog\Service\TagsService;


interface TagsServiceInterface
{
    public function convert(array $convertData, string $content): string;
}