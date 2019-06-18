<?php declare(strict_types=1);


namespace ArchFW\Configuration;

/**
 * Holds all application config
 *
 * @package ArchFW\Configuration
 */
class Config
{
    /** @var ConfigStorage */
    private $routes;

    /** @var ConfigStorage */
    private $settings;

    /** @var ConfigStorage */
    private $paths;

    /**
     * @return ConfigStorage
     */
    public function getRoutes(): ConfigStorage
    {
        return $this->routes;
    }

    /**
     * @param ConfigStorage $routes
     * @return Config
     */
    public function setRoutes(ConfigStorage $routes): Config
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * @return ConfigStorage
     */
    public function getSettings(): ConfigStorage
    {
        return $this->settings;
    }

    /**
     * @param ConfigStorage $settings
     * @return Config
     */
    public function setSettings(ConfigStorage $settings): Config
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * @return ConfigStorage
     */
    public function getPaths(): ConfigStorage
    {
        return $this->paths;
    }

    /**
     * @param ConfigStorage $paths
     * @return Config
     */
    public function setPaths(ConfigStorage $paths): Config
    {
        $this->paths = $paths;
        return $this;
    }
}
