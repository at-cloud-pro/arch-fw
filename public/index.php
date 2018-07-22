<?php

namespace ArchFW;
use \Exception as ArchFWException;

$configFileLocation = '../config.php'; // CONFIG FILE PATH
$vendorFileLocation = '../vendor/autoload.php'; // CONFIG FILE PATH

try {
    // ENSURE CONFIG IS LOADED AND IS ARRAY
    if(!file_exists($configFileLocation)){
        throw new ArchFWException("Config file wasn't found!", 2);
    }
    $cfg = include_once '../config.php'; // LOADING CONFIG

    // ENSURE HAVING VENDOR FILES
    if(!file_exists($vendorFileLocation)) {
        throw new ArchFWException('VENDOR files were not found, run \'composer install\' over main framework folder.', 3);
    }
    include_once $vendorFileLocation; // LOADING APP

    // ENSURE RUNNING PHP AT LEAST 7.0.0
    if (version_compare(PHP_VERSION, '7.0.0') < 0) {
        throw new ArchFWException('You are running ArchFW on unsupported PHP version, minimum: 7.0.0, yours: '.PHP_VERSION, 4);
    }

    try {
        new \ArchFW\Application($cfg, false); // RUNNING APP
    } catch (\ArchFWException $mainClassError) {
        header("Content-Type: text/plain");
        echo ' MAIN CLASS ERROR ' . $e->getCode() . ': ' . $e->getMessage();
        die;
    }

} catch (ArchFWException $e) {
    header("Content-Type: text/plain");
    echo 'INITIAL ERROR ' . $e->getCode() . ': ' . $e->getMessage();
    die;
}
