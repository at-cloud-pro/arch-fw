<?php

namespace ArchFW\Base;

abstract class View
{

    
    private $loader;
    private $twig;

    protected function Render($wrapperfile, $templatefile)
    {
        $this->loader = new \Twig_Loader_Filesystem(CONFIG['twigConfig']['twigTemplatesPath']);

        $this->twig = new \Twig_Environment($this->loader);
        $template = $this->twig->load($templatefile);

        $vars = CONFIG['metaConfig'];

        $vars += require_once CONFIG['twigConfig']['twigWrappersPath'] . $wrapperfile;
        echo $template->render($vars);

    }

}