<?php declare(strict_types=1);

namespace ArchFW\Routing;

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
    /**
     * @param string $path
     * @return array
     */
    public static function loadOne(string $path): array
    {
        // catch file absence
        if (!file_exists($path)) {
            $message = sprintf('Routes file \'%s\' wasn\'t found .', $path);
            throw new RoutesFileNotFoundException($message);
        }

        // load json
        $json = file_get_contents($path);

        return self::decode($json);
    }

    /**
     * @param array $filepaths
     * @return array
     */
    public static function loadMany(array $filepaths): array
    {
        $decoded = [];
        foreach ($filepaths as $path) {
            $decoded[] = self::loadOne($path);
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
