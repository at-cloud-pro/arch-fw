<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\RouteNotFoundException;
use ArchFW\Utilities\UriParser;

class Router implements RouterInterface
{
    /** @var Route */
    private $route;

    /** @var array */
    private $requestGetVars;

    /**
     * Router
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        // parse get variables
        $exploded = explode('?', $uri);
        $this->requestGetVars = array_key_exists(1, $exploded) ? UriParser::getVariables($exploded[1]) : [];

        // parse request URI
        $search = $exploded[0];

        // load routes config
        $routesCfg = RoutesLoader::load('/config/');
        $routes = RoutesParser::parse($routesCfg);

        // assign route
        $this->route = $this->matchRoute($routes, $search);
    }

    /**
     * @return array
     */
    public function getRequestGetVars(): array
    {
        return $this->requestGetVars;
    }

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    private function matchRoute($routes, $key)
    {
        // find the one valid route
        $route = array_values(array_filter($routes, static function ($route) use ($key) {
            /** @var Route $route */
            return $route->getPath() === $key;
        }));

        // catch route not found
        if (!$route instanceof Route) {
            $message = sprintf('Route not found for \'%s\'', $key);
            throw new RouteNotFoundException($message);
        }

        return $route;
    }
}
