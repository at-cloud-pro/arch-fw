<?php declare(strict_types=1);

namespace ArchFW\Routing;

interface RouterInterface
{
    public function getRequestGetVars(): array;
}
