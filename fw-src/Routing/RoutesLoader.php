<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\RoutesFileNotFoundException;
use ArchFW\Exceptions\Routing\RoutesFileStructureViolationException;

/**
 * RoutesLoader
 *
 * @package ArchFW\Routing
 */
class RoutesLoader
{
    /**
     * @param string $path
     * @return array
     * @throws RoutesFileNotFoundException
     * @throws RoutesFileStructureViolationException
     */
    public static function load(string $path): array
    {
        $file = $path . 'routes.json';

        // catch file absence
        if (!file_exists($file)) {
            $message = sprintf('Routes file \'routes.json\' wasn\'t found in \'%s\'.', $path);
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
        if ($array = json_decode($json, true, 512, true)) {
            return $array;
        }

        // catch file content violation
        throw new RoutesFileStructureViolationException('Routes file were loaded, but it\'s content is invalid JSON.');
    }
}
