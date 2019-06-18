<?php declare(strict_types=1);

namespace ArchFW\Configuration;

use ArchFW\Exceptions\Config\ConfigFileNotFound;

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
     * @param string $configFilesPath
     * @return Config
     */
    public function load(string $configFilesPath): Config
    {
        $config = new Config();

        return $config;
    }

    private function loadPaths(): array
    {
        $json = file_get_contents($this->getPath('paths.json'));

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
