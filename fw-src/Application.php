<?php declare(strict_types=1);

namespace ArchFW;

use App\Controllers\InitialScreenController;
use ArchFW\Configuration\ConfigLoader;
use ArchFW\Controllers\AbstractController;
use ArchFW\Routing\Router;
use ArchFW\Storage\SessionStorage;

class Application
{
    /** @var ConfigLoader */
    private $configLoader;

    /** @var SessionStorage */
    private $session;

    /** @var Router */
    private $router;

    /**
     *  Initiates configuration and
     */
    public function __construct()
    {
        $this->configLoader = new ConfigLoader(__DIR__ . '/../config');
        $this->session = new SessionStorage();
        $this->router = new Router($_SERVER['REQUEST_URI']);

    }

    public function handle(): string
    {

        #$controllerName = $this->router->getControllerName;
        #$methodName =  $this->router->getMethodName;


        $controllerName = InitialScreenController::class;
        $methodName = 'render';

        /** @var AbstractController $controller */
        $controller = new $controllerName();

        // load config
        $controller->setConfig($this->configLoader->load())
                   ->setSession($this->session);

        // give further responsibility for user code
        return $controller->$methodName();
    }

}
