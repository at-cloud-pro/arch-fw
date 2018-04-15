<?php
/**
 * Enter here your project documentation
 *
 *
 * PHP version 7.2
 *
 * @category  <enter category>
 * @package   <enter package>
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright MIT License
 * @version   GIT:<git_id>
 * @link      <enter link>
 */

namespace FRAMEWORK;

// SETTING CLASS LOADERS
use FRAMEWORK\Model\Database as Database;

try {
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

    include_once './code/index.php'; // LOADING FRAMEWORK
    $_APP = new Application();
    define('CONFIG', $_APP->getConfig()); // LOADING CONFIG FILE AS CONSTANT
    define('PREFIX', $_APP->getPrefix()); // SETTING PREFIX FROM CONFIG

    $_APP->Router($_APP);
    $_APP->SecureSession();

} catch (Exception $e) {
    // DON'T SHOW STACK TRACE TO DO NOT SHOW DB PASSWORD
    echo ' ERROR : [' . $e->getCode() . ']' . $e->getMessage();
}
