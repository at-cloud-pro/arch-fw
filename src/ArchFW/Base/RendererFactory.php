<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 21 November 2018
 * Time: 0:03
 */

namespace ArchFW\Base;


use ArchFW\Base\Renderers\HTMLRenderer;
use ArchFW\Base\Renderers\JSONRenderer;
use ArchFW\Interfaces\Renderable;
use ArchFW\Interfaces\RenderFactoryInterface;

/**
 * Class RendererFactory
 *
 * @package ArchFW\Base
 */
class RendererFactory implements RenderFactoryInterface
{
    const TYPE_HTML = 'html';
    const TYPE_JSON = 'json';

    /**
     * @param string $type
     * @return Renderable
     */
    public function getInstance(string $type): Renderable
    {
        switch ($type) {
            case self::TYPE_HTML:
                return new HTMLRenderer();
                break;
            case self::TYPE_JSON:
                return new JSONRenderer();
                break;
        }
    }
}