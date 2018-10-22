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

// Example of safe authenticate
// new Authenticator("region");

$json = [
    'state'      => 'working',
    'apiMessage' => 'test done correctly',
    'method'     => $_SERVER['REQUEST_METHOD'],
];

// EXAMPLE OF THROWING ERRORS:
// Application::error(404,"NOT FOUND", "json");


return $json;
