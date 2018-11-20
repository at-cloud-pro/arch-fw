<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 20 November 2018
 * Time: 21:46
 */

namespace ArchFW\Interfaces;

/**
 * Requires methods required to run render in any technology
 *
 * @package ArchFW\Interfaces
 */
interface Renderable
{
    /**
     * Method used to render data
     *
     * @return string
     */
    public function render(): string;
}
