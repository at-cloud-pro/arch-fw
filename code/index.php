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

/**
 * Main program class for
 */
final class Application
{
    /**
     * Keeps page meta info from config file
     *
     * @var array
     */
    private $_meta;

    /**
     * Class constructor that automatically loads config from external file
     *
     * @param string $pageTitle If specified will change default page title into this. If not, will use default from file
     *
     * @return void
     */
    public function __construct($pageTitle = null)
    {
        $this->_meta = require_once "config.php";
    }

    /**
     * Returning array of page details
     *
     * @return array
     */
    public function getPageDetails()
    {
        return $this->_meta;
    }

    /**
     * Loads config.php array from file on app root location
     *
     * @return array Array of settings is returned
     */
    public function getConfig()
    {
        return require "config.php";
    }

    /**
     * Loads config.php array from file on app root location
     *
     * @return array Array of settings is returned
     */
    public function getPrefix()
    {
        $cfg = require "config.php";
        return $cfg['PREFIX'];
    }

    #region ERRORCODES

    /**
     * Method prints cute visual screen with 401 error, shows default message or custom one if given as argument.
     *
     * @param string $errorcode Custom message to show in verbal
     * @return void Launches error screen and stops script
     */
    public function Error401($errorcode = null)
    {
        if (isset($errorcode)) {
            $_SESSION['ERRORCODE'] = $errorcode;
        }
        include_once "code/visual/errorcodes/401.html";
        die();
    }

    /**
     * Method prints cute visual screen with 404 error, shows default message or custom one if given as argument.
     *
     * @param string $errorcode Custom message to show in verbal
     * @return void Launches    error screen and stops script
     */
    public function Error404($errorcode = null)
    {
        if (isset($errorcode)) {
            $_SESSION['ERRORCODE'] = $errorcode;
        }
        include_once "code/visual/errorcodes/404.html";
        die();
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

    public function Router($object)
    {
        $uri = $_SERVER["REQUEST_URI"];
        $_APP = $object;
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
    }

    public function SecureSession()
    {
        session_start();
        if (!isset($_SESSION['init'])) {
            session_regenerate_id();
            $_SESSION['init'] = true;
        }
    }

    public function __destruct()
    {
        $this->_meta = null;

    }

}

abstract class Controller
{
    protected $DATABASE;

    public function __construct()
    {
        $this->DATABASE = new \FRAMEWORK\Model\Database;
    }

    public function __destruct()
    {
        $this->DATABASE = null;
    }
}

abstract class Model
{
    function return ($action) {
        switch ($action) {
            // Returning all data to associative array
            case "returnFetched":
                $fetched = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($fetched == null) {
                    return false;
                } else {
                    return $fetched;
                }

                break;

            // Returning only first entry to associative array
            case "returnOne":
                $fetched = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($fetched == null) {
                    return false;
                } else {
                    return $fetched[0];
                }
                break;
        }
    }
}
