<?php declare(strict_types=1);

namespace ArchFW\Controllers;

use ArchFW\Configuration\Config;
use ArchFW\Storage\SessionStorage;

interface ControllerInterface
{
    public function getConfig(): Config;

    public function setConfig(Config $config): self;

    public function getSession(): SessionStorage;

    public function setSession(SessionStorage $session): self;
}