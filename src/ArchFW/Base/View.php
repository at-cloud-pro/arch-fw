<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
 * 
 * Visit https://github.com/okbrcz/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   3.0
 * @link      https://github.com/okbrcz/ArchFW/
 */

namespace ArchFW\Base;

abstract class View
{

    
    private $loader;
    private $twig;

    protected function Render($wrapperfile, $templatefile)
    {
        try {
            $this->loader = new \Twig_Loader_Filesystem(CONFIG['twigConfig']['twigTemplatesPath']);

            $this->twig = new \Twig_Environment($this->loader);
            $template = $this->twig->load($templatefile);

            $vars = CONFIG['metaConfig'];
            $vars += [
                'stylesheets'=>CONFIG['stylesheets']
            ];

            $vars += require_once CONFIG['twigConfig']['twigWrappersPath'] . $wrapperfile;
            echo $template->render($vars);
        } catch (Exception $t) {
            echo "dupa";
        }
        

        

    }

}