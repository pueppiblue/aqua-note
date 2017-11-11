<?php

namespace AppBundle\Service;


use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, Cache $markdownCache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $markdownCache;
    }

    public function parse(string $string): string
    {
        $key = md5($string);

        if ($this->cache->contains($key)) {
            $string = $this->cache->fetch($key);
        }

        sleep(1);

        $string = $this->markdownParser->transformMarkdown($string);
        $this->cache->save($key, $string);

        return $string;
    }

}
