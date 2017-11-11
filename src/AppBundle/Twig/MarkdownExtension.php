<?php

namespace AppBundle\Twig;

use AppBundle\Service\MarkdownTransformer;
use Twig_Extension;

class MarkdownExtension extends Twig_Extension
{
    /**
     * @var MarkdownTransformer
     */
    private $markdownTransformer;

    public function __construct(MarkdownTransformer $markdownTransformer)
    {

        $this->markdownTransformer = $markdownTransformer;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify', [$this, 'parseMarkdown']),
        ];
    }

    public function parseMarkdown(string $str)
    {
        return $this->markdownTransformer->parse($str);
    }
}