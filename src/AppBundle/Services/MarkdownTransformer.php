<?php
/**
 * Created by PhpStorm.
 * User: jaxle
 * Date: 2/22/2017
 * Time: 4:39 PM
 */

namespace AppBundle\Services;


use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;

    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, Cache $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse($str)
    {


        $cache = $this->cache;
        $key = md5($str);
        if ($cache->contains($key)) {
            return $cache->fetch($key);


        }
        $str = $this->markdownParser
            ->transformMarkdown($str);

        sleep(1); // fake how slow this could be
        $str = $this->markdownParser
            ->transform($str);
        $cache->save($key, $str);

        return $str;
    }
}