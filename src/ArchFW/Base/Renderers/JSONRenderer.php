<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 21 November 2018
 * Time: 0:02
 */

namespace ArchFW\Base\Renderers;


use ArchFW\Interfaces\Renderable;

class JSONRenderer implements Renderable
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
        echo $path;
        die;

    }

    public function render(): string
    {
        return '';
    }
}