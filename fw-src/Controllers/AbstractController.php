<?php declare(strict_types=1);


namespace ArchFW\Controllers;

use ArchFW\Configuration\Config;
use ArchFW\Storage\SessionStorage;

abstract class AbstractController extends RenderableController implements ControllerInterface
{
    /** @var Config */
    private $config;

    /** @var SessionStorage */
    private $session;

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
    public function setConfig(Config $config): ControllerInterface
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
    public function setSession(SessionStorage $session): ControllerInterface
    {
        $this->session = $session;
        return $this;
    }
}
