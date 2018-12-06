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

namespace ArchFW\Views\Renderers;

use ArchFW\Interfaces\Renderable;
use function header;
use function json_encode;

/**
 * Renders JSON as response
 *
 * @package ArchFW\Views\Renderers
 */
abstract class JSONRenderer implements Renderable
{
    /**
     * Prepare to rendering JSON content
     *
     * @param array $values
     * @return string
     */
    public function render(array $values): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($values);
    }
}
