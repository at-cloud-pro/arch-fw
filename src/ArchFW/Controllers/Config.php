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

namespace ArchFW\Controllers;

use ArchFW\Interfaces\Configurable;

/**
 * Class Config used with Property Design pattern holds application configuration data
 *
 * @package ArchFW\Controller
 */
class Config implements Configurable
{
    /**
     * Consts for making Section param easier to use
     */
    public const SECTION_APP = 'app';
    public const SECTION_ROUTER = 'routes';
    public const SECTION_DB = 'database';

    /**
     * @var array all configuration
     */
    private static $cfg = [];

    /**
     * Get value from configuration
     *
     * @param string $section the file where to look for, use class consts to access
     * @param string $key key used to store the data
     * @return mixed value
     */
    public static function get(string $section, string $key)
    {
        return self::$cfg[$section][$key];
    }

    /**
     * Set or override value in configurations
     *
     * @param string $section the file where to look for, use class consts to access
     * @param string $key key used to store the data
     * @param mixed $value value to being stored in config
     */
    public static function set(string $section, string $key, $value): void
    {
        self::$cfg[$section][$key] = $value;
    }

    /**
     * Initially set the whole array trees
     *
     * @param string $key key used to store the data
     * @param mixed $value value to being stored in config
     */
    public static function setAll(string $key, $value): void
    {
        self::$cfg[$key] = $value;
    }
}
