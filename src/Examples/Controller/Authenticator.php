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
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   4.0.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace Examples\Controller;

use ArchAPI\Controller\Authorizator as Auth;

class Authenticator extends Auth
{
    public function getCredintials(string $region): array
    {
        return ['login' => 'password'];
    }
}
