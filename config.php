<?php
/**
 * ArchFW Framework config file, read comments and carefully edit.
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
 * @link      https://github.com/okbrcz/ArchFW/
 */

return [
    # Welcome in config file dear programmer! In care for your safety and comfort we've commented everything what you may change or destroy. Please read comments carefully, deleting some of this lines and settings might be a strong reason why your app isn't working correctly.

    # If you want to add your own setting, place it carefully below this settings, match the key so you won't override actual settings. You can reach this config as defined CONFIG constant in every scope.

    # Production server switch. When set to false, all PHP errors will be hidden, written to logs. When set to true, all PHP erros will occur, helping debug the application.
    'dev' => true,

    # Every page has
    'metaConfig' =>
        [
            'pageTitle' => 'ArchFW installed!',
            'pageEncoding' => 'UTF-8' /* NOT NULL*/,
            'pageLanguage' => "pl" /* NOT NULL*/,
            'pageDescription' => '',
            'pageKeywords' => '',
            'pageAuthor' => "Oskar 'archi_tektur' Barcz",
            'metaComment' => '',
        ],

    # Add new stylesheets easily, just add another stylesheet (copy "Desktop") to see how. You need to provide valid name, type, rel and path. Don't forget to check if browser sees your new stylesheet in Page Inspector or similiar tool. 
    /*
    Example:
    "Desktop" => [
        'name' => 'Style - Desktop',
        'type' => 'text/css',
        'desc' => '',
        'rel' => 'stylesheet',
        'link' => '/css/style-desktop.css',
    ],
    */
    'stylesheets' => [
        "Example" => [
            'name' => 'example stylesheet',
            'type' => 'text/css',
            'desc' => 'This stylesheet is for better view of startup page, ',
            'rel' => 'stylesheet',
            'link' => '/css/example-css.css',
        ],
    ],

    # Here enter database details, if you want to use our extention.
    'DBConfig' =>
        [
            'databaseType' => 'mysql',
            'databaseName' => 'test',
            'server' => 'localhost',
            'user' => 'root',
            'password' => '',
            // additional PDO options - UTF8 by default
            'addInfo' =>
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                ],
        ],

    # Here enter relative paths to TWIG templates and application wrappers. Until you modify framework internal structure (not recommended!), no need to touch this.
    'twigConfig' =>
        [
            'twigWrappersPath' => '../assets/wrappers/',
            'twigTemplatesPath' => '../assets/templates',
        ],

    # Add adresses to our router. Key here is a URL adress user enters, and value is name of wrapper and twig files. When file is in subdirectory, you can use '/', e.g. 'login/recoverpassword'.
    'appRouter' =>
        [
            '/' => 'index',
            '/test' => 'test',
        ],

    # Path to catalogue with errorcodes, files inside should be named like an errors they are written for - e.g. '404.html'. PHP is not allowed in this files. Until you modify framework internal structure (not recommended!), no need to touch this.
    'pathToErrorPages' => '../assets/errorpages',

    # Simple switch to disable API in whole application. If user will try access, app will throw 601 "Api turned off in app config" error.
    'APIrunning' => true,


    # Router in API is matching URL (key here) and wrapper file name (value here)
    'APIrouter' =>
        [
            '/test' => 'test',
            '/routercheck' => 'routercheck',
            '/auth' => 'auth',
        ],

    # Holds path to API wrappers. Until you modify framework internal structure (not recommended!), no need to touch this.
    'APIwrappers' => '../assets/api',
];
