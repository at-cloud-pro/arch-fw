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
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Views\HTMLViews;

use ArchFW\Interfaces\Renderable;
use ArchFW\Views\Renderers\HTMLRenderer;

/**
 * Class InitialScreen
 *
 * @package ArchFW\Views\HTMLViews
 */
class InitialScreen extends HTMLRenderer implements Renderable
{
    public function __construct()
    {
        echo parent::render(
            [
                'version' => $this->getVersion(),
            ]
        );
    }

    /**
     * Returns current framework version. Test function.
     *
     * @return string
     */
    private function getVersion(): string
    {
        return '2.7.0';
    }
}
