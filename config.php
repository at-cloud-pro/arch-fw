<?php
return [
    
    'appconfig' =>
    [
        'pageTitle' => "",
        'pageEncoding' => "UTF-8",
        'pageLanguage' => "pl",
        'pageDescription' => "",
        'pageKeywords' => "",
        'pageAuthor' => "Oskar 'archi_tektur' Barcz"
    ],

    'dbconfig' =>
    [
        "dsn" => 'mysql:host=localhost;dbname=dbls',
        "usr" => 'root',
        "pswd" => '',
        "addInfo" => [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
    ]
    ];