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

// EXAMPLE OF THROWING ERRORS:
// new Error(404,"NOT FOUND", Error::HTML);
// new Authenticator();
$Log = new \ArchFW\Controller\Logger();

$Log->log('Loaded correctly the main screen', 200);
$Log->log('Loaded correctly the main screen with callback', 201, function () {
    echo 'Callback action';
}, 'Message shown on screen');

return ['test' => 'working'];
