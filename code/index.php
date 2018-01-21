<?php
function autoloader($className)
{
        $file = dirname(__FILE__) . '/' . str_replace('_' , '/', $className);
        if (file_exists($path = $file . '.php'))
        {
            require $path;
            return;
        }
}

function Router($PREFIX)
{
    spl_autoload_register("autoloader");
    $uri = $_SERVER["REQUEST_URI"];

    include "code/visual/partial/header.php";
    switch ($uri) {

        case "$PREFIX/":
        include "code/visual/index.php";
        break;

      default:
        include "code/visual/errorcodes/404.html";
        header("HTTP/1.0 404 Not Found");
        break;
      }

      include_once "code/visual/partial/footer.php";
    }
