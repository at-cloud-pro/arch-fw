<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 19 November 2018
 * Time: 19:17
 */

namespace ArchFW\Interfaces;

interface Configurable
{

    /**
     * Get value from configuration
     *
     * @param string $section the file where to look for, use class consts to access
     * @param string $key key used to store the data
     * @return mixed value
     */
    public static function get(string $section, string $key);

    /**
     * Set or override value in configurations
     *
     * @param string $section the file where to look for, use class consts to access
     * @param string $key key used to store the data
     * @param mixed $value value to being stored in config
     */
    public static function set(string $section, string $key, $value): void;
}