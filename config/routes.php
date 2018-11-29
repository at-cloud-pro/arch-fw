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
 * @version   2.6.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

return [
    # Add adresses to our router. Key here is a URL adress user enters, and value is name of wrapper and twig files.
    # When file is in subdirectory, you can use '/', e.g. 'login/recoverpassword'.
    'APProuter'         => [
        '/' => 'index'
    ],

    # Router in API is matching URL (key here) and wrapper file name (value here)
    'APIrouter'         => [
        '/test'        => 'test',
        '/routercheck' => 'routercheck',
        '/auth'        => 'auth'
    ],

    # Redirect all routes that does not match the above scheme to other, defined above route
    # set FALSE to turn off this function
    # set STRING with route to turn on this function
    'redirectOnNoMatch' => '/'

];
