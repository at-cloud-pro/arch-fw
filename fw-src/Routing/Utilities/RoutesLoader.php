<?php declare(strict_types=1);

namespace ArchFW\Routing\Utilities;

use ArchFW\Exceptions\Routing\RoutesFileNotFoundException;
use ArchFW\Exceptions\Routing\RoutesFileStructureViolationException;
use JsonException;

/**
 * RoutesLoader
 *
 * @package ArchFW\Routing
 */
class RoutesLoader
{
    /** @var string */
    private const LOOKUP_PATH = '../config/';

    /**
     * @param string $path
     * @return array
     */
    public static function loadOne(string $path): array
    {
        // catch file absence
        if (!file_exists(self::LOOKUP_PATH . $path)) {
            $message = "Routes file '{$path}' wasn't found .";
            throw new RoutesFileNotFoundException($message);
        }

        // load json
        $json = file_get_contents(self::LOOKUP_PATH . $path);
        $array = self::decode($json);

        // check if routes are defined in loaded files
        if (!array_key_exists('routes', $array)) {
            $path = self::LOOKUP_PATH . $path;
            throw new RoutesFileStructureViolationException("'routes' key missing in file '{$path}'.");
        }

        return $array;
    }

    /**
     * Loads all routes configuration files
     *
     * @param array $filepaths array of links
     * @return array data ready to parsing
     */
    public static function loadMany(array $filepaths): array
    {
        $decoded = [];
        foreach ($filepaths as $path) {
            $a = self::loadOne($path);
            $decoded += $a['routes'];
        }
        return $decoded;
    }

    /**
     * @param string $json
     * @return array
     * @throws RoutesFileStructureViolationException
     */
    private static function decode(string $json): array
    {
        try {
            /** @throws JsonException */
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $ex) {
            throw new RoutesFileStructureViolationException(
                'Routes file were loaded, but it\'s content is not valid JSON.',
                0,
                $ex
            );
        }
    }
}
