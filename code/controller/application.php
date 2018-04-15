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

namespace FRAMEWORK\Controller;

/**
 * Main method class in RFSF framework, implements method such as errors, getting config and many more.
 */
class Application
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
    public static function Error401($errorcode = null)
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
    public static function Error404($errorcode = null)
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
    public static function CookieSetter($cookie_name, $cookie_value)
    {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }

    #endregion

}
