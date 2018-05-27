<?php

return [

    'prefix' => '/fw/public',

    'metaConfig' =>
    [
        'pageTitle' => "Nazwa",
        'pageEncoding' => "UTF-8",
        'pageLanguage' => "pl",
        'pageDescription' => "",
        'pageKeywords' => "",
        'pageAuthor' => "Oskar 'archi_tektur' Barcz",
    ],


    // Here enter database credintials
    'dbconfig' =>
    [
        "dsn" => 'mysql:host=localhost;dbname=localhost',
        "usr" => 'root',
        "pswd" => '',
        "addInfo" => [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'],
    ],


    // Add routing here, in the way like this:
    // "x" => "y"
    // where x is your link and y is your wrapper and template files
    'router' =>
    [
        '/' => 'index',
        '/test/' => 'test'
    ]
];
