<?php declare(strict_types=1);

namespace ArchFW\Controllers;

use ArchFW\Configuration\Config;
use ArchFW\Storage\SessionStorage;

/**
 * Defines what every controller has to have
 *
 * @package ArchFW\Controllers
 */
interface ControllerInterface
{
    public function getConfig(): Config;

    public function getSession(): SessionStorage;
}