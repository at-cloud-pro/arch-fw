<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 19 November 2018
 * Time: 18:57
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
