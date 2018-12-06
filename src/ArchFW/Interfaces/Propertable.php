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

namespace ArchFW\Interfaces;

/**
 * Interface Propertable for Property design pattern
 *
 * @package ArchFW\Interfaces
 */
interface Propertable
{
    /**
     * Returns value
     *
     * @param string $key get value with given key
     * @return mixed datas
     */
    public static function get(string $key);

    /**
     * Sets value
     *
     * @param string $key key where data can be found
     * @param mixed $value value to store
     */
    public static function set(string $key, $value): void;

    /**
     * Check if selected key stores any data
     *
     * @param string $key key where data may be found
     * @return bool true if does, false if not
     */
    public static function exists(string $key): bool;
}
