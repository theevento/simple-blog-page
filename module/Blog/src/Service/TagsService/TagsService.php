<?php


namespace Blog\Service\TagsService;


class TagsService implements TagsServiceInterface
{
    public function convert(array $convertData, string $content): string
    {
        foreach ($convertData as $dataKey => $data) {
            $content = str_replace($dataKey, $data, $content);
        }

        return $content;
    }
}