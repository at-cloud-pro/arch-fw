<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 20 November 2018
 * Time: 21:48
 */

namespace ArchFW\Base\Renderers;

use ArchFW\Base\Render;
use ArchFW\Controller\Config;
use ArchFW\Exceptions\ArchFWException;
use ArchFW\Interfaces\Renderable;
use Twig_Environment as Environment;
use Twig_Loader_Filesystem as Loader;

final class HTMLRenderer extends Render implements Renderable
{

    private $Loader;

    private $Twig;

    private $templateFile;

    private $wrapperFile;

    private $template;

    private $vars;

    /**
     * Renders HTML content of the page
     *
     * @return string
     */
    public function render(): string
    {
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
     * @throws ArchFWException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function prepare(): void
    {
        // Set folders where Twig will look for files
        $this->Loader = new Loader(Config::get(Config::SECTION_APP, 'twigConfig')['twigTemplatesPath']);

        // Create new Twig object
        $this->Twig = new Environment($this->Loader);

        // Load Twig file
        $this->template = $this->Twig->load($this->templateFile);

        // Add variables describing MetaTags and stylesheets
        $this->vars = (Config::get(Config::SECTION_APP, 'metaConfig'));
        $this->vars += [
            'stylesheets' => (Config::get(Config::SECTION_APP, 'stylesheets')),
        ];

        // check if wrapper file exists
        if (!file_exists(Config::get(Config::SECTION_APP, 'twigConfig')['twigWrappersPath'] . $this->wrapperFile)) {
            throw new ArchFWException('No wrapper file found', 600);
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