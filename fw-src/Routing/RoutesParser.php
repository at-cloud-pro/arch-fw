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
     * @param array $routesConfig
     * @return Route[]
     */
    public static function parse(array $routesConfig): array
    {
        $routes = [];
        foreach ($routesConfig['routes'] as $name => $route) {
            $obj = new Route();
            $obj->setPath($route['path'])
                ->setClassName($route['class'])
                ->setMethodName($route['method']);

            $routes[] = $obj;
        }

        return $routes;
    }

    /**
     * @param Route  $route
     * @param string $name
     */
    public function checkIntegrity(Route $route, string $name): void
    {
        if (!class_exists($route->getClassName())) {
            $message = sprintf('Class declared in route \'%s\' not found.', $name);
            throw new GeneralRoutingException($message);
        }

        if (!method_exists($route->getClassName(), $route->getMethodName())) {
            $message = sprintf('Class declared in route \'%s\' has no \'%s\' method.', $name, $route->getMethodName());
            throw new GeneralRoutingException($message);
        }
    }
}
