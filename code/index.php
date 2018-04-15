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

namespace DBLS\Code;

$uri = $_SERVER["REQUEST_URI"];

//LOADING HEADER SECTION
include "code/visual/partial/header.php";

//LOADING CONTENT BASED ON URL
switch ($uri) {
    case PREFIX . "/":
        include_once "code/visual/index.php";
        break;

    default:
        include "code/visual/errorcodes/404.html";
        header("HTTP/1.0 404 Not Found");
        break;
}

//LOADING BOTTOM PAGE
include_once "code/visual/partial/footer.html";
