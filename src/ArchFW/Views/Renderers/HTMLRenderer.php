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
use ArchFW\Controllers\Utils\UriEncoder;
use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Interfaces\Renderable;
use Twig_Environment as Environment;
use Twig_Filter;
use Twig_Loader_Filesystem as Loader;
use Twig_TemplateWrapper;
use function file_exists;

/**
 * Class HTMLRenderer renders HTML page
 *
 * @package ArchFW\Views\Renderers
 */
final class HTMLRenderer implements Renderable
{
    /**
     * Consts for easier creating
     */
    private const EXT_PHP = '.php';
    private const EXT_TWIG = '.twig';

    /**
     * @var string
     */
    private $wrapperFile;

    /**
     * @var string
     */
    private $templateFile;
    /**
     * @var Loader holds Twig file loader
     */
    private $Loader;

    /**
     * @var Environment Holds Twig Environment object
     */
    private $TwigEnv;

    /**
     * @var array wrapper variables to be sent to template
     */
    private $wrapperVars;

    /**
     * HTMLRenderer constructor.
     *
     * @param string $path
     * @throws NoFileFoundException
     */
    public function __construct(string $path)
    {
        // change file locators into valid path
        $this->wrapperFile = $this->locateWrapper($path);
        $this->templateFile = $this->locateTemplate($path);

        $this->wrapperVars = require_once $this->wrapperFile;
    }

    /**
     * Changes file locators into valid wrapper path
     *
     * @param string $path file locator from config
     * @return string valid file path
     * @throws NoFileFoundException when file is not found
     */
    private function locateWrapper(string $path): string
    {
        // create format
        $file = Config::get(Config::SECTION_APP, 'twigConfig')['twigWrappersPath'] . $path . self::EXT_PHP;

        // try to return
        if (!file_exists($file)) {
            throw new NoFileFoundException('Wrapper "' . $file . '" not found.', 601);
        }
        return $file;
    }

    /**
     * Changes file locators into valid template path
     *
     * @param string $path
     * @return string
     * @throws NoFileFoundException
     */
    private function locateTemplate(string $path): string
    {
        // create format
        $file = $path . self::EXT_TWIG;
        $fullPath = Config::get(Config::SECTION_APP, 'twigConfig')['twigTemplatesPath'];

        // try to return
        if (!file_exists($fullPath)) {
            throw new NoFileFoundException('Wrapper "' . $file . '" not found.', 601);
        }
        return $file;
    }

    /**
     * Prepare to rendering HTML content
     *
     * @return string full HTML page
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(): string
    {
        // load Twig objects
        $template = $this->loadTwig();
        // load variables form sources, config etc.
        $array = $this->prepareVars();

        // return ready generated page
        return $template->render($array);
    }

    /**
     * Loads Twig objects
     *
     * @see https://twig.symfony.com/doc/2.x/api.html
     *
     * @return Twig_TemplateWrapper
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function loadTwig(): Twig_TemplateWrapper
    {
        // Set folders where Twig will look for files
        $this->Loader = new Loader(Config::get(Config::SECTION_APP, 'twigConfig')['twigTemplatesPath']);
        // Create new Twig object
        $this->TwigEnv = new Environment($this->Loader);
        // Add extentions (URL-safe encode)
        $filter = new Twig_Filter(
            'safe_uri_encode',
            function ($string) {
                return UriEncoder::encode($string);
            }
        );
        $this->TwigEnv->addFilter($filter);
        // Load Twig file
        return $this->TwigEnv->load($this->templateFile);
    }

    /**
     * Locates and adds variables to templates
     *
     * @return array
     */
    protected function prepareVars(): array
    {
        // Add variables describing MetaTags and stylesheets
        $vars = (Config::get(Config::SECTION_APP, 'metaConfig'));

        // add stylesheets
        $vars += ['stylesheets' => (Config::get(Config::SECTION_APP, 'stylesheets'))];

        // check if wrapper file returns an array
        if (is_array($this->wrapperVars)) {
            // if it does add this array to general variables array
            $vars += $this->wrapperVars;
        }

        return $vars;
    }
}
