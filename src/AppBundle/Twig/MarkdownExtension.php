<?php

namespace AppBundle\Twig;

use Twig_Extension;

class MarkdownExtension extends Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('markdownify', [$this, 'parseMarkdown']),
        ];
    }

    public function parseMarkdown(string $str)
    {
        return strtoupper($str);
    }
}