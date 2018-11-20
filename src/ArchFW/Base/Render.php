<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 20 November 2018
 * Time: 21:45
 */

namespace ArchFW\Base;

use ArchFW\Interfaces\Renderable;

abstract class Render implements Renderable
{
    const CONTENT_HTML = 'text/html';
    const CONTENT_JSON = 'application/html';

    abstract public function prepare();

    abstract public function render(): string;

    public function setContentType(string $content): void
    {
        switch ($content) {
            case self::CONTENT_HTML:
                header('Content-Type ' . self::CONTENT_HTML . '; charset=utf-8');
                break;

            case self::CONTENT_JSON:
                header('Content-Type ' . self::CONTENT_JSON . ';');
                break;
        }
    }
}