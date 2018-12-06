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

/**
 * Created by PhpStorm.
 * User: Oskar Barcz
 * Date: 06.12.2018
 * Time: 18:06
 */

namespace ArchFW\Controllers\Storage;

/**
 * Base class for most type of storages
 *
 * @package ArchFW\Controllers
 */
abstract class AbstractStorage
{

    /**
     * Get data from storage
     *
     * @param string $key
     * @return mixed
     */
    abstract public static function get(string $key);

    /**
     * Sets value with assigned key in storage
     *
     * @param string $key
     * @param $value
     * @return mixed
     */
    abstract public static function set(string $key, $value): void;

    /**
     * Checks if key exists in storage
     *
     * @param string $key
     * @return mixed
     */
    abstract public static function exist(string $key): bool;

}
