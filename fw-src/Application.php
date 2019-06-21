<?php declare(strict_types=1);

namespace ArchFW;

use ArchFW\Configuration\ConfigLoader;
use ArchFW\Controllers\AbstractController;
use ArchFW\Routing\Router;
use ArchFW\Storage\SessionStorage;

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
        $class = $route->getClass();
        $method = $route->getMethod();

        // handle gets
        $_GET = $this->router->getRequestGetVars();


        /** @var AbstractController $controller */
        $controller = new $class();

        // load controller's data
        $controller->setConfig($this->configLoader->load())
                   ->setSession(new SessionStorage());

        // give further responsibility for user code
        return $controller->$method();
    }

}
