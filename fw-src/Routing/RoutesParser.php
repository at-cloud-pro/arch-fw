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
        foreach ($routesConfig['routes'] as $name => $route) {
            $obj = new Route();
            $obj->setPath($route['path'])
                ->setClassName($route['class'])
                ->setMethodName($route['method']);

            // this will throw e on integrity violation
            self::checkIntegrity($obj, $safeZone, $name);

            $routes[] = $obj;
        }

        return $routes;
    }

    /**
     * @param Route  $route
     * @param string $safeZone
     * @param string $name
     */
    public static function checkIntegrity(Route $route, string $safeZone, string $name): void
    {
        if (!class_exists($safeZone . '\\' . $route->getClassName())) {
            $message = sprintf('Class declared in route \'%s\' not found.', $name);
            throw new GeneralRoutingException($message);
        }

        if (!method_exists($safeZone . '\\' . $route->getClassName(), $route->getMethodName())) {
            $message = sprintf('Class declared in route \'%s\' has no \'%s\' method.', $name, $route->getMethodName());
            throw new GeneralRoutingException($message);
        }
    }
}
