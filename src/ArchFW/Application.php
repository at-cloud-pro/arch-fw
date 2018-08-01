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
 * @version   3.0
 * @link      https://github.com/okbrcz/ArchFW/
 */

namespace ArchFW;

use ArchFW\Base\View;
use \Exception as ArchFWException;


final class Application extends View
{

    public function __construct(array $appConfig, $forceHTTPS = true)
    {        
        define('CONFIG', $appConfig); // LOADING CONFIG FILE AS CONSTANT

        if($forceHTTPS) {
            $this->_https();
        }
        $this->_secureSession();
        $file = $this->_router();

        $wrapper = "$file.php";
        $template = "$file.twig";

        parent::Render($wrapper, $template);

    }

    private function _router()
    {
        // CHECK IF APP HAS 
        $uri = explode('/?', $_SERVER['REQUEST_URI']);
        if(array_key_exists(1, $uri)) {
            $_GET = $this->findArgs($uri[1]);
        }

        if(strpos($_SERVER['REQUEST_URI'], '/api') !== false) {
            // RUNS WHEN ACCESSING API
            echo 'api';
            require_once CONFIG['APIwrappers']."/".$this->findFiles($uri[0]."/", false).".php";
        } else {
            return $this->findFiles($uri[0]."/", false);

        }        
    }

    private function findArgs(string $string)
    {
        $args = \explode('&', $string);
        $output = [];

        if(count($args) > 0) {
            foreach ($args as $key => $value) {
                $str = explode('=', $value);
                if(array_key_exists(1, $str)) {
                    $output += [$str[0] => $str[1]];
                } else {
                    if($str[0] != "") {
                        $output += [$str[0] => null];
                    }
                }
            }
        }
        return $output;
    }

    private function findFiles(string $string, bool $isAPI)
    {
        // print_r($string);
        if($isAPI) {
            if(!array_key_exists ($string, CONFIG['apiRouter'])){
                // RUNS WHEN ROUTER KEY NOT FOUND
                throw new \Exception("Router did not found route '$string' in API config file!", 11);
            }
            return CONFIG['appRouter'][$string];
        } else {
            if(!array_key_exists ($string, CONFIG['appRouter'])){
                // RUNS WHEN ROUTER KEY NOT FOUND
                throw new \Exception("Router did not found route '$string' in APP config file!", 11);
            }
            return CONFIG['appRouter'][$string];
        }
        
    }

    public function error($errorCode = null)
    {

    }

    private function _secureSession()
    {
        // RUN SESSION WHEN IT'S NOT RUNNING
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // RESET SESSION ID TO SECURE THE APP
        if (!isset($_SESSION['init'])) {
            session_regenerate_id();
            $_SESSION['init'] = true;
        }
    }

    private function _https() 
    {
        if($_SERVER["HTTPS"] !== "on")
        {
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            exit();
        }
    }
}
