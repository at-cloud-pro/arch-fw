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

abstract class View
{
    private $loader;
    private $twig;

    /**
     *
     *
     * @param $wrapperfile
     * @param $templatefile
     */
    protected function render($wrapperfile, $templatefile)
    {
        $erro = null;

        try {
            $this->loader = new Loader(CONFIG['app']['twigConfig']['twigTemplatesPath']);

            $this->twig = new Environment($this->loader);
            $template = $this->twig->load($templatefile);

            $vars = CONFIG['app']['metaConfig'];
            $vars += [
                'stylesheets' => CONFIG['app']['stylesheets'],
            ];
//            if (is_array($GLOBALS['META'])) {
//                $vars += [
//                    'meta' => $GLOBALS['META'],
//                ];
//            }


            $vars += require_once CONFIG['app']['twigConfig']['twigWrappersPath'] . $wrapperfile;
            echo $template->render($vars);
        } catch (Exception $twigerr) {
            new Error(602, "Twig Error: {$twigerr->getMessage()}", Error::PLAIN);
        }
    }
}