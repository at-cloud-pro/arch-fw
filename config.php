<?php

/**
 * ArchFW Framework config file, read comments and carefully edit.
 * 
 * Don't be afraid to add yours 
 * 
 * @category  Framework
 * @package   ArchFW
 * @author    Oskar 'archi_tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   3.0
 */

return [

    // Enter here location of main index.php file differential path from server root
    'prefix' => '/fw/public',

    // Page meta informations if NOT NULL appears - field can't be null
    'metaConfig' =>
    [
        'pageTitle' => "Tytuł",
        'pageEncoding' => "UTF-8" /* NOT NULL*/,
        'pageLanguage' => "pl " /* NOT NULL*/,
        'pageDescription' => "",
        'pageKeywords' => "",
        'pageAuthor' => "Oskar 'archi_tektur' Barcz",
    ],

    // Here enter database credintials
    'DBConfig' =>
    [
        "dsn" => 'mysql:host=localhost;dbname=localhost',
        "usr" => 'root',
        "pswd" => '',
        "addInfo" => [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'],
    ],

    // Contains direct paths to wrapper files and twig templates
    'twigConfig' =>
    [
        'twigWrappersPath' => "../assets/wrappers/",
        'twigTemplatesPath' => '..\assets\templates'
    ],

    // Add routing here, in the way like this:
    // "x" => "y"
    // where x is your link and y is your wrapper and template files
    'router' =>
    [
        '/' => 'index',
        '/test/' => 'test'
    ],

    // Advanced router is used for articles and many more regular elements. 
    'advancedRouter' => 
    [
        // there's no routes by default
    ]
];
