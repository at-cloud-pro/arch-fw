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
 * @author    Oskar 'archi-tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   2.8.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Views\Renderers;

use ArchFW\Controllers\Config;
use ArchFW\Controllers\Router;
use ArchFW\Controllers\Utils\UriEncoder;
use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Interfaces\Renderable;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;
use Twig\TwigFilter;
use function array_merge;
use function is_array;

/**
 * Class HTMLRenderer renders HTML page
 *
 * @package ArchFW\Views\Renderers
 */
abstract class HTMLRenderer implements Renderable
{
    /**
     * @param array $variablesFromView
     * @return string
     * @throws LoaderError
     * @throws NoFileFoundException
     * @throws RuntimeError
     * @throws SyntaxError
     */
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
     * @return TemplateWrapper
     * @throws NoFileFoundException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    private function loadTwig(): TemplateWrapper
    {
        // Set folders where Twig will look for files
        $loader = new FilesystemLoader(Config::get(Config::SECTION_APP, 'templatesPath'));
        // Create new Twig object
        $twigEnv = new Environment($loader);
        // Add extentions (URL-safe encode)
        $filter = new TwigFilter(
            'safe_uri_encode',
            function ($string) {
                return UriEncoder::encode($string);
            }
        );
        $twigEnv->addFilter($filter);
        // Load Twig file
        return $twigEnv->load($this->locateTemplate());
    }

    /**
     * @return string
     * @throws NoFileFoundException
     */
    private function locateTemplate(): string
    {
        $path = Config::get(Config::SECTION_APP, 'templatesPath');
        $file = Router::getTemplateName();
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
        $vars = [];

        // Add variables describing MetaTags and stylesheets
        $vars += Config::get(Config::SECTION_APP, 'metaConfig');

        // add stylesheets
        $vars += ['stylesheets' => Config::get(Config::SECTION_APP, 'stylesheets')];

        // check if wrapper file returns an array
        if (is_array($variablesFromView)) {
            // if it does add this array to general variables array
            $vars = array_merge($vars, $variablesFromView);
        }

        return $vars;
    }
}
