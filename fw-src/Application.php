<?php declare(strict_types=1);

namespace ArchFW;

use ArchFW\Configuration\ConfigLoader;
use ArchFW\Controllers\AbstractController;
use ArchFW\Controllers\ControllerInterface;
use ArchFW\Exceptions\Routing\ControllerNotExtendsBaseException;
use ArchFW\Exceptions\Routing\MethodNotFound;
use ArchFW\Storage\SessionStorage;

class Application
{
    /** @var ConfigLoader */
    protected $configLoader;

    /** @var SessionStorage */
    protected $session;

    /**
     *  Initiates configuration and
     */
    public function construct(): void
    {
        $this->configLoader = new ConfigLoader('/config');
        $this->session = new SessionStorage();
    }

    public function handle(): string
    {
        // fast fix
        // that values will be returned by router
        $controllerName = AbstractController::class;
        $methodName = 'render';

        /** @var AbstractController $controller */
        $controller = new $controllerName();

        // load config
        if (!$controller instanceof ControllerInterface) {
            throw new ControllerNotExtendsBaseException('Your controller has to extend AbstractController class.');
        }
        $controller->setConfig($this->configLoader->load())
                   ->setSession($this->session);

        // give responsibility now for user code
        if (!method_exists($controller, $methodName)) {
            $message = sprintf('Method %s not found in %s.', $methodName, $controllerName);
            throw new MethodNotFound($message);
        }
        return $controller->$methodName;
    }
}