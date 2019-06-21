<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\GeneralRoutingException;

/**
 * RoutesParser
 *
 * @package ArchFW\Routing
 */
class RoutesParser
{
    /**
     * @param array  $routesConfig
     * @param string $safeZone
     * @return Route[]
     */
    public static function parse(array $routesConfig, string $safeZone): array
    {
        $routes = [];
        $iterator = 0;

        foreach ($routesConfig['routes'] as $name => $route) {
            $obj = new Route();
            $obj->setId($iterator)
                ->setName($name)
                ->setPath($route['path'])
                ->setClass($routesConfig['safe-zone'] . '\\' . $route['class'])
                ->setMethod($route['method']);

            // this will throw e on integrity violation
            self::checkIntegrity($obj, $safeZone);

            $routes[] = $obj;
            $iterator++;
        }

//        dump($routes);
        return $routes;
    }

    /**
     * @param Route  $route
     * @param string $safeZone
     */
    public static function checkIntegrity(Route $route, string $safeZone): void
    {
        // check class exist
        if (!class_exists($route->getClass())) {
            $message = sprintf('Class declared in route \'%s\' not found.', $route->getName());
            throw new GeneralRoutingException($message);
        }

        // check method exist
        if (!method_exists($route->getClass(), $route->getMethod())) {
            $message = sprintf(
                'Class declared in route \'%s\' has no \'%s\' method.',
                $route->getName(),
                $route->getMethod()
            );
            throw new GeneralRoutingException($message);
        }
    }
}
