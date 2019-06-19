<?php declare(strict_types=1);

namespace ArchFW\Routing;

/**
 * RoutesParser
 *
 * @package ArchFW\Routing
 */
class RoutesParser
{
    /**
     * @param array $routesConfig
     * @return Route[]
     */
    public static function parse(array $routesConfig): array
    {
        $routes = [];
        foreach ($routesConfig['routes'] as $route) {
            $obj = new Route();
            $obj->setPath($route['path'])
                ->setClassName($route['class'])
                ->setMethodName($route['method']);

            $routes[] = $obj;
        }

        return $routes;
    }

    public function checkIntegrity()
    {

    }
}
