<?php declare(strict_types=1);

namespace ArchFW\Routing;

interface RouterInterface
{
    public function getControllerName(): string;

    public function setControllerName(string $controllerName): Router;

    public function getMethodName(): string;

    public function setMethodName(string $methodName): Router;
}
