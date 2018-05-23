<?php

return [

    'prefix' => '/fw/public',

    'metaConfig' =>
    [
        'pageTitle' => "DBLS",
        'pageEncoding' => "UTF-8",
        'pageLanguage' => "pl",
        'pageDescription' => "",
        'pageKeywords' => "",
        'pageAuthor' => "Oskar 'archi_tektur' Barcz",
    ],

    'dbconfig' =>
    [
        "dsn" => 'mysql:host=localhost;dbname=localhost',
        "usr" => 'root',
        "pswd" => '',
        "addInfo" => [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'],
    ],

    'router' =>
    [
        '/fw/public/' => 'index',
        'dupa' => 'login',

    ]
];
