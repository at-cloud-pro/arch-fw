<?php

namespace ArchFW;

try {
    $cfg = include_once '../config.php'; // LOADING CONFIG
    include_once '../vendor/autoload.php'; // LOADING APP
    $_APP = new Application($cfg); // RUNNING APP

} catch (PDOException $e) {
    // DON'T SHOW STACK TRACE TO DO NOT SHOW DB PASSWORD
    echo ' ERROR : [' . $e->getCode() . ']' . $e->getMessage();
}
