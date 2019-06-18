<?php declare(strict_types=1);

namespace ArchFW\Configuration;

class ConfigLoader
{
    public static function load(): Config
    {
        $config = new Config();


        return $config;
    }
}
