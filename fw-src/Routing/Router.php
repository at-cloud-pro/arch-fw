<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\GeneralRoutingException;
use ArchFW\Exceptions\Routing\RouteNotFoundException;
use ArchFW\Utilities\UriParser;

class Router implements RouterInterface
{
    /** @var Route */
    private $route;

    /** @var array */
    private $requestGetVars;

    /** @var string */
    private $safeZone;

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
        $routesCfg = RoutesLoader::load('../config/');
        $routes = RoutesParser::parse($routesCfg);

        // assign safe zone
        if (!array_key_exists('safe-zone', $routesCfg)) {
            throw new GeneralRoutingException('Config has no safe zone settings.');
        }
        $this->safeZone = $routesCfg['safe-zone'];

        // assign route
        $this->route = $this->matchRoute($routes, $search);
    }

    /**
     * Matches route
     *
     * @param array  $routes
     * @param string $key
     * @return mixed
     */
    private function matchRoute(array $routes, string $key)
    {
        // find the one valid route
        $route = array_values(array_filter($routes, static function ($route) use ($key) {
            /** @var Route $route */
            return $route->getPath() === $key;
        }))[0];

        // catch route not found
        if (!$route instanceof Route) {
            $message = sprintf('Route not found for \'%s\'', $key);
            throw new RouteNotFoundException($message);
        }

        return $route;
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

    public function getSafeZone(): string
    {
        return $this->safeZone;
    }
}
