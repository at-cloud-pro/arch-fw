<?php declare(strict_types=1);

namespace ArchFW;

use ArchFW\Configuration\ConfigLoader;
use ArchFW\Controllers\ControllerInterface;
use ArchFW\Routing\Router;
use ArchFW\Utilities\ControllerBuilder;

class Application
{
    /** @var ConfigLoader */
    private $configLoader;

    /** @var Router */
    private $router;

    /**
     *  Initiates application for request
     */
    public function __construct()
    {
        $this->configLoader = new ConfigLoader(__DIR__ . '/../config');
        $this->router = new Router($_SERVER['REQUEST_URI']);

    }

    /**
     * Handles request.
     *
     * @return string
     */
    public function handle(): string
    {
        // prepare data
        $route = $this->router->matchRoute();
        $method = $route->getMethod();

        // handle gets
        $_GET = $this->router->getRequestGetVars();

        /** @var ControllerInterface $controller */
        $controller = ControllerBuilder::build($route, $this->configLoader->load());

        // give further responsibility for user code
        return $controller->$method();
    }

}
