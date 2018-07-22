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

use \Exception as ArchFWException;

abstract class View
{
    private $loader;
    private $twig;

    protected function _render($wrapperfile, $templatefile)
    {
        try {
            $twigFilePath = CONFIG['twigConfig']['twigTemplatesPath'];
            $wrapperFilePath = CONFIG['twigConfig']['twigWrappersPath'];

            // THROW EXCEPTION WHEN TWIG DIRECTORY DOES NOT EXIST
            if(!file_exists($twigFilePath)) {
                throw new ArchFWException('Twig files directory providen in config wasn\'t found.', 21);
            }
            $this->loader = new \Twig_Loader_Filesystem($twigFilePath);
            $this->twig = new \Twig_Environment($this->loader);

            // THROW EXCEPTION WHEN TWIG FILE WASN'T FOUND
            if(!file_exists($twigFilePath.'/'.$templatefile)) {
                throw new ArchFWException("Twig file was't found in \"$twigFilePath\". File should be named \"$templatefile\", but it's not available.", 22);
            }
            $template = $this->twig->load($templatefile);

            // IF METADATA IS SPECIFIED, INCLUDE IT
            if (is_array(CONFIG['metaConfig'])) {
                $vars = CONFIG['metaConfig'];
            } else $vars = [];

            // IF STYLESHEETS ARE SPECIFIED, INCLUDE THEM
            if (is_array(CONFIG['stylesheets'])) {
                $vars += ['stylesheets' => CONFIG['stylesheets']];
            }
            // CHECKING IF PROGRAMMER USED WRAPPER FILE WITH VARIABLES, THEN INCLUDE IT
            if ((file_exists($wrapperFilePath . $wrapperfile)) and (is_array($arg = require_once $wrapperFilePath . $wrapperfile))) {
                $vars += $arg;
            }

            // DISPLAY THE WEBPAGE
            echo $template->render($vars);
        } catch (ArchFWException $backerr) {
            header("Content-Type: text/plain");
            echo 'BACKEND RENDER ERROR ' . $backerr->getCode() . ': ' . $backerr->getMessage();
        }
    }

}