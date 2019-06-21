<?php declare(strict_types=1);

namespace ArchFW\Controllers\Interfaces;

use ArchFW\Configuration\Config;
use ArchFW\Storage\SessionStorage;

/**
 * Defines what every controller has to have
 *
 * @package ArchFW\Controllers
 * @method setSession(SessionStorage $sessionStorage)
 * @method setConfig(Config $config)
 */
interface ControllerInterface
{
    public function getConfig(): Config;

    public function getSession(): SessionStorage;

    public function redirect(string $pathName): void;
}