<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 *  @category  Framework/Boilerplate
 *  @package   ArchFW
 *  @author    Oskar Barcz <kontakt@archi-tektur.pl>
 *  @copyright 2018 Oskar 'archi_tektur' Barcz
 *  @license   MIT
 *  @version   2.6.0
 *  @link      https://github.com/archi-tektur/ArchFW/
 */

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
     * Renderable constructor expects path to files
     *
     * @param string $path
     */
    public function __construct(string $path);

    /**
     * Method used to render data
     *
     * @return string
     */
    public function render(): string;
}
