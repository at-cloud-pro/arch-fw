<?php declare(strict_types=1);

namespace ArchFW\Routing\Abstracts;

interface RouterInterface
{
    public function getRequestGetVars(): array;
}
