<?php
/**
 * Project title
 * 
 * Longer project description
 * 
 * PHP version 7.2
 * 
 * @category  Cateogry
 * @package   AppName
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   URL http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT:<git_id>
 * @link      URL link
 */

/** 
 * Autoloader that loads class when needed
 * 
 * @param string $className required class name
 * 
 * @return void
 */
function autoloader($className)
{
    $file = dirname(__FILE__) . '/' . str_replace('_' , '/', $className);
    if (file_exists($path = $file . '.php')) {
        include $path;
        return;
    }
}

/**
 * Does the all-about router things
 * 
 * @param {string|null} $PREFIX Prefix of the file
 * 
 * @return void
 */
function router($PREFIX)
{
    spl_autoload_register("autoloader");
    $uri = $_SERVER["REQUEST_URI"];

    include "code/visual/partial/header.php";
    switch ($uri) {
    case $PREFIX."/":
        include "code/visual/index.php";
        break;

    default:
        include "code/visual/errorcodes/404.html";
        header("HTTP/1.0 404 Not Found");
        break;
    }
      include_once "code/visual/partial/footer.html";
}
