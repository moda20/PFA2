<?php
/**
 * Created by PhpStorm.
 * User: jaxle
 * Date: 2/23/2017
 * Time: 11:18 AM
 */

namespace AppBundle\Twig;




use AppBundle\Services\MarkdownTransformer;

class MarkdownExtension extends \Twig_Extension
{


    private $markdownTransformer;

    public function __construct(MarkdownTransformer $markdownTransformer)
    {
        $this->markdownTransformer = $markdownTransformer;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('markdownify', array($this, 'parsemarkdown'),[
                'is_safe'=> ['html']
            ])
        );
    }
    public function parsemarkdown($str){
        return $this->markdownTransformer->parse($str);
    }

    public function getName()
    {
     return 'app_markdown';
    }

}