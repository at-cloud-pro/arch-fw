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

namespace ArchFW\Exceptions;

use Throwable;

/**
 * Thrown when file do not exist
 *
 * @package ArchFW\Exceptions
 */
class RenderException extends ArchFWException implements Throwable
{
}
