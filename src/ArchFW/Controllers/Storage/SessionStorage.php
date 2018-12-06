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

namespace ArchFW\Controllers\Storage;

use function array_key_exists;

/**
 * Holds data in HTTP Session
 *
 * @package ArchFW\Controllers\Storage
 */
class SessionStorage extends AbstractStorage
{
    /**
     * Gets value from HTTP Session by key
     *
     * @param string $key
     * @return mixed|null
     */
    public static function get(string $key)
    {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

    /**
     * Sets value to HTTP Session by key
     *
     * @param string $key
     * @param $value
     */
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Checks if HTTP Session has given key
     *
     * @param string $key
     * @return bool
     */
    public static function exist(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}
