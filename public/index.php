<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
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
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW;

use ArchFW\Application as App;
use ArchFW\Controller\Error;
use Exception;

$config = '../config.php'; // CONFIG FILE PATH
$vendor = '../vendor/autoload.php'; // CONFIG FILE PATH

try {
    // ENSURE CONFIG IS LOADED
    if (!file_exists($config)) {
        throw new Exception("Config file wasn't found!", 2);
    }
    $cfg = include_once $config; // LOADING CONFIG

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
        new App($cfg, false); // RUNNING APP
    } catch (Exception $mainClassError) {
        if ($cfg['dev']) {
            new Error(404, 'MAIN CLASS ERROR ' . $mainClassError->getCode() . ': ' . $mainClassError->getMessage(), Error::PLAIN);
        } else {
            new Error(404, 'Not Found', Error::HTML);
        }
    }

} catch (Exception $e) {
    http_response_code(500);
    if (isset($cfg) and $cfg['dev']) {
        new Error(404, 'INITIAL ERROR ' . $e->getCode() . ': ' . $e->getMessage(), Error::PLAIN);
    } else {
        ini_set("display_errors", 0);
        ini_set("log_errors", 1);
        new Error(500, "Initial Error happened, turn on dev mode to diagnose.", Error::PLAIN);
    }

}