<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 20 November 2018
 * Time: 21:46
 */

namespace ArchFW\Interfaces;

interface Renderable
{
    /**
     * @return mixed
     */
    public function prepare();

    /**
     * Method used to render data
     *
     * @return string
     */
    public function render(): string;
}
