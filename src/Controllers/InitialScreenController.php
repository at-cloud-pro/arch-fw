<?php declare(strict_types=1);

namespace App\Controllers;

use ArchFW\Controllers\AbstractRenderController;

class InitialScreenController extends AbstractRenderController
{
    public function index(): string
    {
        return 'hello, world';
    }
}
