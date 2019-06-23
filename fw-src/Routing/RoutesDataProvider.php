<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\RoutesFileNotFoundException;
use ArchFW\Exceptions\Routing\RoutesFileStructureViolationException;

/**
 * RoutesDataProvider
 *
 * @package ArchFW\Routing
 */
class RoutesDataProvider
{
    /**
     * @param string $path
     * @return array
     * @throws RoutesFileNotFoundException
     * @throws RoutesFileStructureViolationException
     */
    public static function load(string $path): array
    {
        $file = $path . 'routing.json';

        // catch file absence
        if (!file_exists($file)) {
            $message = sprintf('Routes file \'routing.json\' wasn\'t found in \'%s\'.', $path);
            throw new RoutesFileNotFoundException($message);
        }

        // load json
        $json = file_get_contents($file);

        return self::decode($json);
    }

    /**
     * @param string $json
     * @return array
     * @throws RoutesFileStructureViolationException
     */
    private static function decode(string $json): array
    {
        // if json is valid
        if ($array = json_decode($json, true, 512, JSON_THROW_ON_ERROR)) {
            return $array;
        }

        // catch file content violation
        throw new RoutesFileStructureViolationException('Routes file were loaded, but it\'s content is invalid JSON.');
    }
}
