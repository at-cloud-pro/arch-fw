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

namespace ArchFW;

use Exception;

$config = '../config'; // CONFIG FILE PATH
$vendor = '../vendor/autoload.php'; // CONFIG FILE PATH

try {
    // ENSURE CONFIG IS LOADED
    if (!file_exists($config)) {
        throw new Exception('Config file wasn\'t found!', 2);
    }

    // ENSURE RUNNING PHP AT LEAST 7.0.0
    if (version_compare(PHP_VERSION, '7.0.0') < 0) {
        throw new Exception('You are running ArchFW on unsupported PHP version, minimum: 7.0.0, yours: ' . PHP_VERSION, 4);
    }

    // ENSURE HAVING VENDOR FILES
    if (!file_exists($vendor)) {
        throw new Exception('VENDOR files were not found, run \'composer install\' over main framework folder.', 3);
    }
    include_once $vendor; // LOADING LIBS AND CLASSES

    try {
        new Application($config); // RUNNING APP
    } catch (Exception $mainClassError) {
        header('Content-Type text/plain');
        http_response_code(404);
        exit('FATAL ERROR ' . $mainClassError->getCode() . ': ' . $mainClassError->getMessage());
    }

} catch (Exception $err) {
    http_response_code(500);
    exit('INIT ERROR ' . $err->getCode() . ': ' . $err->getMessage());
}