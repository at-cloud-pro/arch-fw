<?php declare(strict_types=1);

namespace ArchFW\Utilities;

use ArchFW\Configuration\Config;
use ArchFW\Controllers\AbstractTwigRenderController;
use ArchFW\Controllers\Interfaces\ControllerInterface;
use ArchFW\Renderers\TwigRenderer;
use ArchFW\Routing\Route;
use ArchFW\Storage\SessionStorage;

/**
 * ControllerBuilder
 *
 * @package ArchFW\Utilities
 */
class ControllerBuilder
{
    /**
     * Controls controller building
     *
     * @param Route  $route
     * @param Config $config
     *
     * @return ControllerInterface
     */
    public static function build(Route $route, Config $config): ControllerInterface
    {
        $class = $route->getClass();
        /** @var ControllerInterface $controller */
        $controller = new $class();

        $controller->setSession(new SessionStorage());
        $controller->setConfig($config);

        if ($controller instanceof AbstractTwigRenderController) {
            $renderer = new TwigRenderer();
            $controller->setRenderer($renderer);
        }

        return $controller;
    }
}