<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework / Template
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.5.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchAPI\Controller;

/**
 * IAuthorizator extort usage of getCredintials method in developer's written Authorizator class extention (child).
 */
interface IAuthorizator
{
    /**
     * Returns array with user logins and passwords
     *
     * @var string $region region which user has to access
     *
     * @return array with logins and passwords
     */
    function getCredintials(string $region): array;
}
