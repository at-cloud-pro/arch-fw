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

use ArchFW\Base\View;
use \Exception as ArchFWException;

/**
 * Representation of ArchFW Application
 * 
 * Contains methods such error handling, routing securing session and ensuring security over HTTPS
 */
final class Application extends View
{

    public function __construct(array $appConfig, bool $forceHTTPS = true, bool $dev = false)
    {        
        define('CONFIG', $appConfig); // LOADING CONFIG FILE AS CONSTANT
        define('DEVMODE', $dev);

        if($forceHTTPS) {
            $this->_https();
        }
        $this->_secureSession();
        $file = $this->_router();

        $wrapper = "$file.php";
        $template = "$file.twig";

        parent::Render($wrapper, $template);
    }
    
    /**
     * Showing visual or JSON style errors
     *
     * @param integer $code HTTP code of an error to be thrown
     * @param string $message message to be shown
     * @param string $method Choose between method to show error, values: html|plain|json
     * 
     * @return void
     */
    static public function error(int $code,string $message,string $method)
    {
        http_response_code($code);
        switch ($method) {
            case 'html':
                $path = CONFIG['pathToErrorPages']."/$code.html";
                if(file_exists($path)){
                    require_once $path;
                    die;
                } 
                else {
                    header('Content-Type: text/plain');
                    exit("ERROR $code OCCURED, WITH MESSAGE '$message'. ERROR-SPECIFIC FILES WERE NOT FOUND.");
                }
                    
            case 'json':
                header('Content-Type: application/json');
                exit(json_encode([
                    'error' => true,
                    'errorCode' => $code,
                    'errorMessage' => $message,
                ]));
            
            case 'plain': 
                header('Content-Type: text/plain');
                exit("ERROR $code OCCURED, WITH MESSAGE '$message'. ERROR-SPECIFIC FILES WERE NOT FOUND.");
        }
    }

    /**
     * Whole big method for assigning wrappers and templates depending on URI
     * 
     * Depending on URI returns API wrappers or TWIG Templates and PHP Wrappers
     *
     * @return string filename that has to be loaded
     */
    private function _router()
    {
        // CHECK IF APP HAS 
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        if(array_key_exists(1, $uri)) {
            $_GET = $this->findArgs($uri[1]);
        }

        if(strpos($_SERVER['REQUEST_URI'], '/api/') !== false) {
            return $this->findFiles($uri[0], true);
        }
        return $this->findFiles($uri[0], false);       
    }

    /**
     * Returns array of GET values in URI
     * 
     * Simple gets all data after '?', then puts it in an array. Required if using REST style routing. Run function and assing returned values to $_GET variable.
     *
     * @param string $string
     * @return void
     */
    private function findArgs(string $string)
    {
        $args = explode('&', $string);
        $output = [];

        if(count($args) > 0) {
            foreach ($args as $key => $value) {
                $str = explode('=', $value);
                if(array_key_exists(1, $str)) {
                    $output += [$str[0] => $str[1]];
                } else if($str[0] != "") {
                    $output += [$str[0] => null];
                }
            }
        }
        return $output;
    }

    /**
     * Finds file name for specified URI
     * 
     * Function is checking if in config file is specified which file app should load when user enters specified URI. By default looking for twig templates, if $isAPI variable is set to true, only loads API wrapper.
     *
     * @param string $string Requested URI file part
     * @param boolean $isAPI Set to true when accessing API server
     * @return string Returns filename when found
     * @throws Exception when route were not found
     */
    private function findFiles(string $string, bool $isAPI)
    {
        if($isAPI) {
        // RUNS IF SERVER MAY BE USED AS API SERVO
            if(CONFIG['APIrunning'] === false) {
                header("Content-Type: application/json");
                echo json_encode([
                    'error' => true,
                    'errorCode' => 601,
                    'errorMessage' => 'API functionality were turned off in app config file on server.'
                ]);
                exit;
            }

            $string = str_replace("/api", null, $string);
            if(!array_key_exists ($string, CONFIG['APIrouter'])){
                throw new \Exception("Router did not found route '$string' in API config file!", 11);
            }
            header("Content-Type: application/json");

            $file = CONFIG['APIwrappers']."/".CONFIG['APIrouter'][$string];
            if(!file_exists("$file.php")){
                throw new \Exception("File does not exists!", 11);
            }
            $json = require_once "$file.php";
            echo json_encode($json);
            exit;
        } else {
            if(!array_key_exists ($string, CONFIG['appRouter'])){
                throw new \Exception("Router did not found route '$string' in APP config file!", 11);
            }
            return CONFIG['appRouter'][$string];
        }
    }


    /**
     * Ensures that app has loaded session safely
     *
     * @return void
     */
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

    /**
     * Enforcing on app usage of HTTP Secure protocol instead of normal HTTP
     * 
     * If page is detected to run over HTTP only, page will be redirected to HTTPS. Run only on compatible servers, may cause problems if server does not offer HTTPS connections.
     *
     * @return void
     */
    private function _https() 
    {
        if($_SERVER["HTTPS"] !== "on")
        {
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            exit();
        }
    }
}
