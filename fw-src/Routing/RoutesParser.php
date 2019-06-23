<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Exceptions\Routing\CustomRendererClassNotFoundException;
use ArchFW\Exceptions\Routing\GeneralRoutingException;
use ArchFW\Exceptions\Routing\RendererNotInterfacedException;
use ArchFW\Renderers\RenderableInterface;
use ArchFW\Renderers\TwigRenderer;

class RoutesParser
{
    /**
     * @param array $routesConfig
     * @return Route[]
     */
    public static function parse(array $routesConfig): array
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
            self::checkIntegrity($obj);

            // make it render-able
            self::assignRenderer($route, $obj);

            $routes[] = $obj;
            $iterator++;
        }

        return $routes;
    }

    /**
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
     * @param array $route
     * @param Route $obj
     * @return Route
     */
    private static function assignRenderer(array $route, Route $obj): Route
    {
        $renderer = array_key_exists('renderer', $route) ? $route['renderer'] : TwigRenderer::class;

        // skip further testing in case same class as default
        if ($renderer === TwigRenderer::class) {
            return $obj->setRenderer(new TwigRenderer());
        }

        // check if class extends correct interface
        if (!is_a($renderer, RenderableInterface::class, true)) {
            throw new RendererNotInterfacedException('Custom renderer has to extends RenderableInterface.');
        }

        if (!class_exists($renderer)) {
            throw new CustomRendererClassNotFoundException('Custom renderer class not found.');
        }

        // assign renderer
        /** @var RenderableInterface $renderer */
        return $obj->setRenderer(new $renderer());
    }
}
