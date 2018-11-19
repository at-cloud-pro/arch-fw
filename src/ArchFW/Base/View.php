<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.5.1
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Base;

use ArchFW\Controller\Config;
use ArchFW\Controller\Error;
use ArchFW\Exceptions\ArchFWException;
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
            $this->loader = new Loader(Config::get(Config::SECTION_APP, 'twigConfig')['twigTemplatesPath']);

            $this->twig = new Environment($this->loader);
            $template = $this->twig->load($templatefile);

            $variables = (Config::get(Config::SECTION_APP, 'metaConfig'));
            $variables += [
                'stylesheets' => (Config::get(Config::SECTION_APP, 'stylesheets')),
            ];

            if (!file_exists(Config::get(Config::SECTION_APP, 'twigConfig')['twigWrappersPath'] . $wrapperfile)) {
                throw new ArchFWException('No wrapper file found', 600);
            }
            if (is_array(
                $arr = require_once(Config::get(Config::SECTION_APP, 'twigConfig')
                    ['twigWrappersPath'] . $wrapperfile)
            )) {
                $variables += $arr;
            }
            echo $template->render($variables);
        } catch (ArchFWException $twigerr) {
            new Error(404, "Twig Error: {$twigerr->getMessage()}", Error::PLAIN);
        } catch (Exception $e) {
            new Error(404, "Twig Error: {$e->getMessage()}", Error::PLAIN);
        }
    }
}