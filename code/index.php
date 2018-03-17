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
    $file = dirname(__FILE__) . '/' . str_replace('_', '/', $className);
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

    // NAJPIERW SPRAWDŹ CZY ADRES NIE PROWADZI DO ARTYKUŁU, JEŻELI TAK, TO GO WCZYTAJ
    if (strpos($uri, 'articles/') !== false) {
        include "code/visual/article.php";
        die();
    }
    // JEŻELI NIE, URUCHOM STANDARDOWY ROUTER
    else {
        switch ($uri) {

            case "$PREFIX/":
                include "code/visual/index.php";
                break;

            case "$PREFIX/registration-complete":
                include "code/visual/confirmation.php";
                break;

            case "$PREFIX/login":
                include "code/visual/poweradmin/login.php";
                break;

            case "$PREFIX/admin":
                include "code/visual/poweradmin/admin.php";
                break;

            case "$PREFIX/admin/teams/cs":
                $_SESSION['currentTeamList'] = 'cs';
                include "code/visual/poweradmin/teamlist.php";
                break;

            case "$PREFIX/admin/teams/lol":
                $_SESSION['currentTeamList'] = 'lol';
                include "code/visual/poweradmin/teamlist.php";
                break;

            case "$PREFIX/admin/register":
                include "code/visual/poweradmin/registrysettings.php";
                break;

            case "$PREFIX/admin/adduser":
                include "code/visual/poweradmin/adduser.php";
                break;
            case "$PREFIX/admin/pswdchg":
                include "code/visual/poweradmin/passwordchange.php";
                break;

            case "$PREFIX/logoff":
                session_destroy();
                header("Location: $PREFIX/");
                break;

            default:
                include "code/visual/errorcodes/404.html";
                header("HTTP/1.0 404 Not Found");
                break;
        }

    }

    include_once "code/visual/partial/footer.html";
}
