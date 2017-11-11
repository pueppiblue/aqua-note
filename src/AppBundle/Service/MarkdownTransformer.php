<?php

namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\Parser\MarkdownParser;

class MarkdownTransformer
{
    private $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse(string $string): string
    {

        return $this->markdownParser->transform($string);
    }

}