<?php declare(strict_types=1);


namespace ArchFW\Controllers;

use ArchFW\Configuration\Config;
use ArchFW\Controllers\Interfaces\ControllerInterface;
use ArchFW\Routing\Router;
use ArchFW\Storage\SessionStorage;

/**
 * AbstractController
 *
 * @package ArchFW\Controllers
 */
abstract class AbstractController implements ControllerInterface
{
    /** @var Config */
    private $config;

    /** @var SessionStorage */
    private $session;

    /**
     * @var Router
     */
    private $router;

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return AbstractController
     */
    public function setConfig(Config $config): AbstractController
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return SessionStorage
     */
    public function getSession(): SessionStorage
    {
        return $this->session;
    }

    /**
     * @param SessionStorage $session
     * @return AbstractController
     */
    public function setSession(SessionStorage $session): AbstractController
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Sends redirection header to browser
     *
     * @param string $pathName
     */
    public function redirect(string $pathName): void
    {
        $url = $this->router->getAdressForRoute($pathName);
        header("Location {$url}");
    }

    /**
     * @param Router $router
     * @return AbstractController
     */
    public function setRouter(Router $router): AbstractController
    {
        $this->router = $router;
        return $this;
    }
}
