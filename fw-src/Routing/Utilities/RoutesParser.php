<?php declare(strict_types=1);

namespace ArchFW\Routing\Utilities;

use ArchFW\Exceptions\Routing\CustomRendererClassNotFoundException;
use ArchFW\Exceptions\Routing\DefaultRendererClassNotFound;
use ArchFW\Exceptions\Routing\GeneralRoutingException;
use ArchFW\Exceptions\Routing\RendererNotInterfacedException;
use ArchFW\Renderers\RenderableInterface;
use ArchFW\Renderers\TwigRenderer;
use ArchFW\Routing\ValueObjects\Route;

/**
 * Class with route parsing utilities
 *
 * @package ArchFW\Routing
 */
class RoutesParser
{
    /** @var array holds routes config */
    private $generalConfig;

    /** @var array[] */
    private $routesToParse = [];

    /**
     * RoutesParse
     *
     * @param array $generalConfig
     */
    public function __construct(array $generalConfig)
    {
        $this->generalConfig = $generalConfig;
    }

    /**
     * Parses data loaded from routing files to Route collection
     *
     * @return Route[]
     */
    public function parseAll(): array
    {
        //collect all route config files into one big array
        $this->routesToParse = $this->generalConfig['routes'];

        // if include paths are selected, load it
        if (array_key_exists('include-paths', $this->generalConfig)) {
            $includes = RoutesLoader::loadMany($this->generalConfig['include-paths']);
            foreach ($includes as $name => $route) {
                $this->routesToParse[$name] = $route;
            }
        }

        // set array collectors
        $parsedRoutes = [];
        $id = 0;

        // parse all
        foreach ($this->routesToParse as $name => $route) {
            $obj = $this->dataToRoute($id, $name, $route);
            $parsedRoutes[] = $obj;
            $id++;
        }
        return $parsedRoutes;

    }

    /**
     * Parses simple route from config to Route object
     *
     * @param int    $id        route ID
     * @param string $routeName route individual name
     * @param array  $routeData one route config
     * @return Route
     */
    private function dataToRoute(int $id, string $routeName, array $routeData): Route
    {
        $obj = new Route();
        $obj->setId($id)
            ->setName($routeName)
            ->setPath($routeData['path'])
            ->setClass($this->generalConfig['safe-zone'] . '\\' . $routeData['class'])
            ->setMethod($routeData['method']);

        // this will throw e on integrity violation
        $this->checkIntegrity($obj);

        // select default renderer
        $defaultRenderer = array_key_exists('default-renderer', $this->generalConfig)
            ? $this->generalConfig['default-renderer']
            : TwigRenderer::class;

        // make it render-able
        self::assignRenderer($routeData, $obj, $defaultRenderer);

        return $obj;
    }

    /**
     * Checks route integrity
     *
     * @param Route $route
     */
    private function checkIntegrity(Route $route): void
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

    /**
     * Assigns renderer to Route object definition
     *
     * This function also checks if
     *
     * @param array  $route           route settings array from file
     * @param Route  $obj             current object to assign
     * @param string $defaultRenderer default renderer to be used if no other is specified
     * @return Route
     */
    private static function assignRenderer(array $route, Route $obj, string $defaultRenderer): Route
    {
        //skip further testing in case default renderer is internal renderer
        if ($defaultRenderer === TwigRenderer::class) {
            return $obj->setRenderer(new TwigRenderer());
        }

        // first, check if default renderer even exists
        if (!class_exists($defaultRenderer)) {
            throw new DefaultRendererClassNotFound('Default renderer class not found.');
        }

        // check if default renderer is render-able
        if (!is_a($defaultRenderer, RenderableInterface::class, true)) {
            throw new RendererNotInterfacedException('Default renderer has to extends RenderableInterface.');
        }

        // select other than default renderer if specified
        $renderer = array_key_exists('renderer', $route) ? $route['renderer'] : $defaultRenderer;

        // skip further testing in case same class as default
        if ($renderer === $defaultRenderer) {
            return $obj->setRenderer(new TwigRenderer());
        }

        // check if custom render class exists
        if (!class_exists($renderer)) {
            throw new CustomRendererClassNotFoundException('Custom renderer class not found.');
        }

        // check if class extends correct interface
        if (!is_a($renderer, RenderableInterface::class, true)) {
            throw new RendererNotInterfacedException('Custom renderer has to extends RenderableInterface.');
        }

        // assign renderer
        /** @var RenderableInterface $renderer */
        return $obj->setRenderer(new $renderer());
    }
}
