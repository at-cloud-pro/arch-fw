<?php declare(strict_types=1);

namespace ArchFW\Configuration;

use ArchFW\Exceptions\Config\ConfigFileNotFound;
use ArchFW\Utilities\JsonToStorageTransformer as Transformer;

class ConfigLoader
{
    /**
     * @var string
     */
    private $configFilesPath;

    public function __construct(string $configFilesPath)
    {
        if (is_dir($configFilesPath)) {
            $this->configFilesPath = $configFilesPath;
        }
    }

    /**
     * @return Config
     */
    public function load(): Config
    {
        $config = new Config();
        $config->setPaths($this->loadAppConfig())
               ->setRoutes($this->loadRoutes());


        return $config;
    }

    private function loadRoutes(): ConfigStorage
    {
        $json = file_get_contents($this->getPath('routes.json'));
        return Transformer::transform($json);
    }

    private function loadAppConfig(): ConfigStorage
    {
        $json = file_get_contents($this->getPath('paths.json'));
        return Transformer::transform($json);
    }

    /**
     * @param $filename
     * @return string
     */
    private function getPath($filename): string
    {
        $path = $this->configFilesPath . DIRECTORY_SEPARATOR . $filename;
        if (is_file($path)) {
            return $path;
        }
        $message = sprintf("Config file '%s' not found in '%s", $filename, $this->configFilesPath);
        throw new ConfigFileNotFound($message);
    }
}
