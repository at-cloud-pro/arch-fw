<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar 'archi-tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Interfaces;

/**
 * Interface that requires that user who used Error class will implement his own _action() method
 */
interface Errorable
{

    /**
     * IError constructor.
     *
     * @param int $code
     * @param string $message
     * @param string $method
     */
    public function __construct(int $code, string $message, string $method);

    /**
     * Action which is given to user. By default it's doing nothing,
     * but while overriding this function by inheritance user may add his own needs.
     *
     * @return void
     */
    public function action(): void;
}
