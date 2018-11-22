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

namespace ArchFW\Interfaces;

use ArchFW\Exceptions\NoFileFoundException;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;
use Twig_TemplateWrapper;

/**
 * Requires methods required to run render in any technology
 *
 * @package ArchFW\Interfaces
 */
interface Renderable
{
    /**
     * Renderable constructor expects path to files
     *
     * @param string $path
     * @throws NoFileFoundException
     */
    public function __construct(string $path);

    /**
     * Method used to render data
     *
     * @return string complete response
     * @return Twig_TemplateWrapper
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function render(): string;
}
