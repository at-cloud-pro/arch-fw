<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 19 November 2018
 * Time: 18:29
 */

namespace ArchFW\Model;

/*
 * Property design pattern object
 */

class RouterData
{
    private static $data = [];

    public static function set(string $key, $value): void
    {
        self::$data[$key] = $value;
    }

    public static function get(string $key)
    {
        return self::$data[$key];
    }

    public static function exists(string $key): bool
    {
        return isset(self::$data[$key]);
    }
}