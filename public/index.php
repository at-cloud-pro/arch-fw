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
use \Exception as ArchFWException;

use ArchFW\Application as App;

$config = '../config.php'; // CONFIG FILE PATH
$vendor = '../vendor/autoload.php'; // CONFIG FILE PATH

try {
    // ENSURE CONFIG IS LOADED AND IS ARRAY
    if(!file_exists($config)){
        throw new ArchFWException("Config file wasn't found!", 2);
    }
    $cfg = include_once $config; // LOADING CONFIG

    // ENSURE HAVING VENDOR FILES
    if(!file_exists($vendor)) {
        throw new ArchFWException('VENDOR files were not found, run \'composer install\' over main framework folder.', 3);
    }
    include_once $vendor; // LOADING APP

    // ENSURE RUNNING PHP AT LEAST 7.0.0
    if (version_compare(PHP_VERSION, '7.0.0') < 0) {
        throw new ArchFWException('You are running ArchFW on unsupported PHP version, minimum: 7.0.0, yours: '.PHP_VERSION, 4);
    }

    // TRY TO RUN APP AND CATCH EXCEPTIONS
    try {
        $_APP = new App($cfg, false, true); // RUNNING APP
    } catch (ArchFWException $mainClassError) {
        if ($cfg['dev']) {
            App::error(404, 'MAIN CLASS ERROR ' . $mainClassError->getCode() . ': ' . $mainClassError->getMessage(), 'plain');
        } else {
            App::error(404, "", 'html');
        }
    }

} catch (ArchFWException $e) {
    http_response_code(500);
    if (isset($cfg) and $cfg['dev']) {
        header("Content-Type: text/plain");
        exit('INITIAL ERROR ' . $e->getCode() . ': ' . $e->getMessage());
    } else {
        ini_set("display_errors", 0);
        ini_set("log_errors", 1);
        header('Content-Type: text/plain');
        exit("Initial Error happened, turn on dev mode to diagnose.");
    }
    
}
