<?php

/**
 * DBLS - Deutsche Bahn Lokfuhrer Seite - application made for TS2017
 *
 * This page were made for school project and for Train Simulator
 * 2017 purposes. This page has no affilation and never had any
 * with Deutsche Bahn AG.
 * Well, application is made for printing train drive schedule,
 * track distant signalling and other details to make Train
 * Simulator 2017 even more real.
 * I am in possibility to share access to this app, for that please
 * contact me by form available at the bottom of the
 * www.archi-tektur.pl page.
 *
 * PHP version 7.2
 *
 * @category  Transport
 * @package   DBLS
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT:<git_id>
 * @link      https://dbls.eu
 */

namespace FRAMEWORK;

// SETTING CLASS LOADERS
use FRAMEWORK\Controller\Application as App;
use FRAMEWORK\Model\Database as Database;

// AUTOLOAD CLASSES ON DEMAND
spl_autoload_register(function ($class) {
    $prefix = 'FRAMEWORK\\';
    $length = strlen($prefix);
    $base_directory = __DIR__ . '/code/';
    if (strncmp($prefix, $class, $length) !== 0) {
        return;
    }
    $relative_class = substr($class, $length);
    $file = $base_directory . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

//STARTING SESSION AND MAKING IT SECURE
session_start();
if (!isset($_SESSION['init'])) {
    session_regenerate_id();
    $_SESSION['init'] = true;
}

//DEFINING CONSTANTS
define('CONFIG', App::getConfig()); // LOADING CONFIG FILE AS CONSTANT
define('PREFIX', App::getPrefix()); // SETTING PREFIX FROM CONFIG

try {
    include_once './code/index.php'; // LOADING FRAMEWORK
} catch (Exception $e) {
    // DON'T SHOW STACK TRACE TO DO NOT SHOW DB PASSWORD
    echo ' ERROR : [' . $e->getCode() . ']' . $e->getMessage();
}
