<?php declare(strict_types=1);

namespace ArchFW;

use ArchFW\Configuration\Config;
use ArchFW\Configuration\ConfigLoader;
use Exception;

class Application
{
    /** @var Config */
    protected $config;

    /**
     *  Initiates configuration and
     */
    public function construct()
    {
        try {
            $this->config = ConfigLoader::load('/config');

        } catch (Exception $exception) {

        } finally {

        }
    }

    public function handle()
    {

    }
}