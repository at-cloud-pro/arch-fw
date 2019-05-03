<?php declare(strict_types=1);
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
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Views\HTMLViews;

use ArchFW\Application;
use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Views\Renderers\HTMLRenderer;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class InitialScreen
 *
 * @package ArchFW\Views\HTMLViews
 */
class InitialScreen extends HTMLRenderer
{
    /**
     * Assigns data from arguments as class fields
     *
     * @throws NoFileFoundException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __construct()
    {
        echo $this->render([
            'version' => Application::VERSION,
        ]);
    }
}
