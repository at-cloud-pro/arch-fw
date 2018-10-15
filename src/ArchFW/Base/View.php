<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework / Template
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.5.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Base;

use ArchFW\Controller\Error;
use Exception;
use Twig_Environment as Environment;
use Twig_Loader_Filesystem as Loader;

/**
 * Class View
 *
 * @package ArchFW\Base
 */
abstract class View
{
    /**
     * @var
     */
    private $loader;
    /**
     * @var
     */
    private $twig;

    /**
     * Render
     *
     * @param string $wrapperfile
     * @param string $templatefile
     */
    protected function render(string $wrapperfile, string $templatefile)
    {
        $erro = null;

        try {
            $this->loader = new Loader(CONFIG['app']['twigConfig']['twigTemplatesPath']);

            $this->twig = new Environment($this->loader);
            $template = $this->twig->load($templatefile);

            $variables = CONFIG['app']['metaConfig'];
            $variables += [
                'stylesheets' => CONFIG['app']['stylesheets'],
            ];
            /*
            if (is_array($GLOBALS['META'])) {
                $vars += [
                'meta' => $GLOBALS['META'],
                ];
            }*/


            $variables += require_once CONFIG['app']['twigConfig']['twigWrappersPath'] . $wrapperfile;
            echo $template->render($variables);
        } catch (Exception $twigerr) {
            new Error(602, "Twig Error: {$twigerr->getMessage()}", Error::PLAIN);
        }
    }
}