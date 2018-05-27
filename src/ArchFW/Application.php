<?php
/**
 * DBLS - Deutsche Bahn Lokfuhrer Seite - application made for TS2017
 *
 * This page were made for school project and for Train Simulator
 * 2017 purposes. This page has no affilation and never had any
 * with Deutsche Bahn AG.
 * Well, application is made for printing train drive schedule,
 * track distant signalling and other details to make Train
 * Simulator 2017 even more real.
 * I am in possibility to share access to this app, for that please
 * contact me by form available at the bottom of the
 * www.archi-tektur.pl page.
 *
 * PHP version 7.2
 *
 * @category  Transport
 * @package   DBLS
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   3.0
 * @link      https://dbls.eu
 */

namespace ArchFW;

use ArchFW\Base\View;

/**
 * Main method class in RFSF framework, implement methods such as errors, getting config and many more.
 */
final class Application extends View
{

    private $_meta;


    public function __construct(array $appConfig)
    {        

        define('CONFIG', $appConfig); // LOADING CONFIG FILE AS CONSTANT

        $this->SecureSession();
        $this->Router();
    }

    private function Router()
    {

        $route = explode(CONFIG['prefix'], $_SERVER["REQUEST_URI"]);

        if(!array_key_exists ( $route[1] , CONFIG['router'] )){
            // RUNS WHEN ROUTER KEY NOT FOUND
            echo "ROUTER NOT FOUND, ADD OR CHECK config.php ENTRY!";
            die;

        }
        
        $file = CONFIG['router'][$route[1]];
        
        $wrapper = "$file.php";
        $template = "$file.twig"; 
   
        parent::Render($wrapper, $template);

    }

    #region ERRORCODES
    /**
     * Method prints cute visual screen with 404 error, shows default message or custom one if given as argument.
     *
     * @param string $errorcode Custom message to show in verbal
     * @return void Launches    error screen and stops script
     */
    public function Error($errorCode = null)
    {

    }

    /**
     * Method used for setting cookies. Remember to inform user about cookie usage on page (GPDR). This method is setting cookie onluy for one month - (86400 * 30) seconds.
     *
     * @param string $cookie_name  Cookie index name
     * @param mixed $cookie_value Cookie value
     * @return void
     */
    public function CookieSetter($cookie_name, $cookie_value)
    {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }

    /**
     * Arranges secure session in application
     *
     * @return void Function is not returning any values.
     */
    private function SecureSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['init'])) {
            session_regenerate_id();
            $_SESSION['init'] = true;
        }
    }
}
