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

/**
 * Created by PhpStorm.
 * User: konta
 * Date: 19 November 2018
 * Time: 18:29
 */

namespace ArchFW\Model;

use ArchFW\Interfaces\Propertable;

/**
 * Property design pattern object
 *
 * @package ArchFW\Model
 */
class RouterData implements Propertable
{
    /**
     * @var array datas
     */
    private static $data = [];

    /**
     * Sets value
     *
     * @param string $key key where data can be found
     * @param mixed $value value to store
     */
    public static function set(string $key, $value): void
    {
        self::$data[$key] = $value;
    }

    /**
     * Returns value
     *
     * @param string $key get value with given key
     * @return mixed datas
     */
    public static function get(string $key)
    {
        return self::$data[$key];
    }

    /**
     * Check if selected key stores any data
     *
     * @param string $key key where data may be found
     * @return bool true if does, false if not
     */
    public static function exists(string $key): bool
    {
        return isset(self::$data[$key]);
    }
}
