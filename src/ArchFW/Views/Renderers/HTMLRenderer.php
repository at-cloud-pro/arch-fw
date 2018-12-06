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
 * @version   2.6.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Views\Renderers;

use ArchFW\Controllers\Config;
use ArchFW\Controllers\Router;
use ArchFW\Controllers\Utils\UriEncoder;
use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Interfaces\Renderable;
use Twig_Environment as Environment;
use Twig_Filter;
use Twig_Loader_Filesystem as Loader;
use Twig_TemplateWrapper;

/**
 * Class HTMLRenderer renders HTML page
 *
 * @package ArchFW\Views\Renderers
 */
abstract class HTMLRenderer implements Renderable
{
    final public function render($variablesFromView): string
    {
        // load Twig objects
        $template = $this->loadTwig();
        // load variables form sources, config etc.
        $preparedVars = $this->prepareVars($variablesFromView);

        // return ready generated page
        return $template->render($preparedVars);
    }

    /**
     * @return Twig_TemplateWrapper
     * @throws NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function loadTwig(): Twig_TemplateWrapper
    {
        // Set folders where Twig will look for files
        $Loader = new Loader(Config::get(Config::SECTION_APP, 'templatesPath'));
        // Create new Twig object
        $TwigEnv = new Environment($Loader);
        // Add extentions (URL-safe encode)
        $filter = new Twig_Filter(
            'safe_uri_encode',
            function ($string) {
                return UriEncoder::encode($string);
            }
        );
        $TwigEnv->addFilter($filter);
        // Load Twig file
        return $TwigEnv->load($this->locateTemplate());
    }

    /**
     * @return string
     * @throws NoFileFoundException
     */
    private function locateTemplate(): string
    {
        $path = Config::get(Config::SECTION_APP, 'templatesPath');
        $file = Router::getTemplateName() . '.twig';
        $pathToFile = $path . DIRECTORY_SEPARATOR . $file;

        // test if file exists
        if (!file_exists($pathToFile)) {
            throw new NoFileFoundException('Template wasn\'t found.');
        }

        return $file;
    }

    /**
     * Locates and adds variables to templates
     *
     * @param array $variablesFromView
     * @return array
     */
    protected function prepareVars(array $variablesFromView): array
    {
        // Add variables describing MetaTags and stylesheets
        $vars = (Config::get(Config::SECTION_APP, 'metaConfig'));

        // add stylesheets
        $vars += ['stylesheets' => (Config::get(Config::SECTION_APP, 'stylesheets'))];

        // check if wrapper file returns an array
        if (is_array($variablesFromView)) {
            // if it does add this array to general variables array
            $vars += $variablesFromView;
        }

        return $vars;
    }
}
