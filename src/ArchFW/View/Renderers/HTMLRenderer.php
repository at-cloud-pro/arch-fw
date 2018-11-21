<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 *  @category  Framework/Boilerplate
 *  @package   ArchFW
 *  @author    Oskar Barcz <kontakt@archi-tektur.pl>
 *  @copyright 2018 Oskar 'archi_tektur' Barcz
 *  @license   MIT
 *  @version   2.6.0
 *  @link      https://github.com/archi-tektur/ArchFW/
 */

/**
 * Created by PhpStorm.
 * User: konta
 * Date: 20 November 2018
 * Time: 21:48
 */

namespace ArchFW\View\Renderers;

use ArchFW\Controller\Config;
use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Interfaces\Renderable;
use Twig_Environment as Environment;
use Twig_Loader_Filesystem as Loader;
use Twig_TemplateWrapper;

/**
 * Class HTMLRenderer renders HTML page
 *
 * @package ArchFW\View\Renderers
 */
final class HTMLRenderer implements Renderable
{

    /**
     * @var Loader holds Twig file loader
     */
    private $Loader;

    /**
     * @var Environment Holds Twig Environment object
     */
    private $TwigEnv;

    /**
     * @var string holds path to template file
     */
    private $templateFile;

    /**
     * @var string holds path to wrapper file
     */
    private $wrapperFile;

    /**
     * @var Twig_TemplateWrapper holds actual choosen template
     */
    private $template;

    /**
     * @var array variables to be sent to template
     */
    private $vars;

    public function __construct(string $path)
    {
    }

    /**
     * Renders HTML content of the page
     *
     * @return string
     * @throws NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(): string
    {
        $this->prepare();

        // return ready generated page
        return $this->template->render($this->vars);
    }

    /**
     * Sets wrapper and template files
     *
     * @param string $templateFile relative path to template file
     * @param string $wrapperFile relative path to wrapper file
     */
    public function setFiles(string $templateFile, string $wrapperFile): void
    {
        $this->templateFile = $templateFile;
        $this->wrapperFile = $wrapperFile;
    }

    /**
     * Prepare all data to being rendered
     *
     * @return void
     * @throws \ArchFW\Exceptions\NoFileFoundException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function prepare(): void
    {
        // Set folders where Twig will look for files
        $this->Loader = new Loader(Config::get(Config::SECTION_APP, 'twigConfig')['twigTemplatesPath']);

        // Create new Twig object
        $this->TwigEnv = new Environment($this->Loader);

        // Load Twig file
        $this->template = $this->TwigEnv->load($this->templateFile);

        // Add variables describing MetaTags and stylesheets
        $this->vars = (Config::get(Config::SECTION_APP, 'metaConfig'));
        $this->vars += [
            'stylesheets' => (Config::get(Config::SECTION_APP, 'stylesheets')),
        ];

        // check if wrapper file exists
        if (!file_exists(Config::get(Config::SECTION_APP, 'twigConfig')['twigWrappersPath'] . $this->wrapperFile)) {
            throw new NoFileFoundException('No wrapper file found', 600);
        }

        // check if wrapper file returns an array
        if (is_array(
            $arr = require_once(Config::get(Config::SECTION_APP, 'twigConfig')
                ['twigWrappersPath'] . $this->wrapperFile)
        )) {
            // if it does add this array to general variables array
            $this->vars += $arr;
        }
    }
}