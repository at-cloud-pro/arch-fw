<?php declare(strict_types=1);


namespace ArchFW\Configuration;

/**
 * Holds all application config
 *
 * @package ArchFW\Configuration
 */
class Config
{
    /** @var ConfigLoader */
    private $routes;

    /** @var ConfigLoader */
    private $settings;

    /** @var ConfigLoader */
    private $paths;

    /**
     * @return ConfigLoader
     */
    public function getRoutes(): ConfigLoader
    {
        return $this->routes;
    }

    /**
     * @param ConfigLoader $routes
     * @return Config
     */
    public function setRoutes(ConfigLoader $routes): Config
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * @return ConfigLoader
     */
    public function getSettings(): ConfigLoader
    {
        return $this->settings;
    }

    /**
     * @param ConfigLoader $settings
     * @return Config
     */
    public function setSettings(ConfigLoader $settings): Config
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @return ConfigLoader
     */
    public function getPaths(): ConfigLoader
    {
        return $this->paths;
    }

    /**
     * @param ConfigLoader $paths
     * @return Config
     */
    public function setPaths(ConfigLoader $paths): Config
    {
        $this->paths = $paths;
        return $this;
    }
}
