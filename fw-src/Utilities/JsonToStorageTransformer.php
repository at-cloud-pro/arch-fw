<?php declare(strict_types=1);

namespace ArchFW\Utilities;

use ArchFW\Configuration\ConfigStorage;

/**
 * Transforms JSON to ConfigStorage
 *
 * @package ArchFW\Utilities
 */
class JsonToStorageTransformer
{
    /**
     * @param string $json
     * @return ConfigStorage
     */
    public static function transform(string $json): ConfigStorage
    {
        $data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        $storage = new ConfigStorage();
        $storage->loadAll($data);
        return $storage;
    }
}
