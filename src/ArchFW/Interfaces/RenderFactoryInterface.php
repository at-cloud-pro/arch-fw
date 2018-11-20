<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 21 November 2018
 * Time: 0:20
 */

namespace ArchFW\Interfaces;

/**
 * Interface RenderFactoryInterface
 *
 * @package ArchFW\Interfaces
 */
interface RenderFactoryInterface
{
    /**
     * @param string $type
     * @return mixed
     */
    public function getInstance(string $type): Renderable;
}
