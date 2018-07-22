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

/**
 * Main method class in RFSF framework, implement methods such as errors, getting config and many more.
 */
final class Application extends View
{

    public function __construct(array $appConfig, $forceHTTPS = true)
    {        
        define('CONFIG', $appConfig); // LOADING CONFIG FILE AS CONSTANT

        if($forceHTTPS) {
            $this->_https();
        }
        $this->_secureSession();
        $file = $this->_router($_SERVER["REQUEST_URI"]);

        $wrapper = "$file.php";
        $template = "$file.twig"; 
   
        parent::Render($wrapper, $template);
    }

    private function _router($uri)
    {
        //search for first request phrase in advancedrouter config file 
        if(array_search("/".explode("/",$uri)[1],  CONFIG['advancedRouter']) !== false ) {

            $route = "/".explode("/",$_SERVER["REQUEST_URI"])[1];
            return CONFIG['router'][$route];

        } else if(CONFIG['prefix'] !== "") {
            $route = explode(CONFIG['prefix'], $uri);
            if(!array_key_exists ($route[1], CONFIG['router'])){
                // RUNS WHEN ROUTER KEY NOT FOUND
                throw new ArchFWException("ADVANCED ROUTER MISCONFIGURED, ADD OR CHECK config.php ENTRY!", 11);
            }
            return CONFIG['router'][$route[1]];            
        }
        if(!array_key_exists ($uri, CONFIG['router'])){
            // RUNS WHEN ROUTER KEY NOT FOUND
            throw new ArchFWException("Router did not found route '$uri' in config file!", 11);
        }
        return CONFIG['router'][$uri];
    }

    #region ERRORCODES
    /**
     * Method prints cute visual screen with 404 error, shows default message or custom one if given as argument.
     *
     * @param string $errorcode Custom message to show in verbal
     * @return void Launches    error screen and stops script
     */
    public function error($errorCode = null)
    {

    }

    /**
     * Arranges secure session in application
     *
     * @return void Function is not returning any values.
     */
    private function _secureSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['init'])) {
            session_regenerate_id();
            $_SESSION['init'] = true;
        }
    }

    private function _https() 
    {
        if($_SERVER["HTTPS"] != "on")
        {
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            exit();
        }
    }
}
