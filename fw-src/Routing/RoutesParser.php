<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\CustomRendererClassNotFoundException;
use ArchFW\Exceptions\Routing\DefaultRendererClassNotFound;
use ArchFW\Exceptions\Routing\GeneralRoutingException;
use ArchFW\Exceptions\Routing\RendererNotInterfacedException;
use ArchFW\Renderers\RenderableInterface;
use ArchFW\Renderers\TwigRenderer;

/**
 * Class with static route parsing utilities
 *
 * @package ArchFW\Routing
 */
class RoutesParser
{
    /**
     * Parses data loaded from routing files to Route collection
     *
     * @param array $generalConfig
     * @return Route[]
     */
    public static function parseAll(array $generalConfig): array
    {
        $routes = [];
        $iterator = 0;

        foreach ($generalConfig['routes'] as $name => $route) {
            $obj = self::parseOne($iterator, $name, $route, $generalConfig);
            $routes[] = $obj;
            $iterator++;
        }

        return $routes;
    }

    /**
     * Parses simple route from config to Route object
     *
     * @param int    $iterator      route ID
     * @param string $name          route individual name
     * @param array  $route         one route config
     * @param array  $generalConfig general config
     * @return Route
     */
    public static function parseOne(int $iterator, string $name, array $route, array $generalConfig): Route
    {
        $obj = new Route();
        $obj->setId($iterator)
            ->setName($name)
            ->setPath($route['path'])
            ->setClass($generalConfig['safe-zone'] . '\\' . $route['class'])
            ->setMethod($route['method']);

        // this will throw e on integrity violation
        self::checkIntegrity($obj);

        // select default renderer
        $defaultRenderer = array_key_exists('default-renderer', $generalConfig)
            ? $generalConfig['default-renderer']
            : TwigRenderer::class;

        // make it render-able
        self::assignRenderer($route, $obj, $defaultRenderer);

        return $obj;
    }

    /**
     * Checks route integrity
     *
     * @param Route $route
     */
    public static function checkIntegrity(Route $route): void
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

        // check if render class exists
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
