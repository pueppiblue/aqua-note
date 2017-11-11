<?php

namespace AppBundle\Service;


class MarkdownTransformer
{
    public function parse(string $string): string
    {
        return strtoupper($string);
    }

}