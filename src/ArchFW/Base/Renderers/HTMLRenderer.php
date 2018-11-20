<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 20 November 2018
 * Time: 21:48
 */

namespace ArchFW\Base\Renderers;


use ArchFW\Base\Render;
use ArchFW\Interfaces\Renderable;

class HTMLRenderer extends Render implements Renderable
{
    public function render(): string
    {
        return '';
    }

    public function prepare()
    {
        // TODO: Implement prepare() method.
    }
}