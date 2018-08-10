<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
 *
 * Visit https://github.com/okbrcz/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   4.0
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
