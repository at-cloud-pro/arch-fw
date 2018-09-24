<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
 *
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
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
use ArchFW\Controller\Router;

/**
 * Representation of ArchFW Application
 *
 * Contains methods such securing session and ensuring security over HTTPS. It's also an app starter - constructor here does all stuff you need to run an app. App will not check validity of vendor or config, so you have to do it separately.
 */
final class Application extends View
{
    /**
     * Holds pointer to application router
     *
     * @var Router
     */
    private $Router;

    /**
     * Application constructor. Main method that is running selected classes, initiate session and router.
     *
     * @param array $appConfig
     */
    public function __construct(array $appConfig)
    {
        define('CONFIG', $appConfig); // LOADING CONFIG FILE AS CONSTANT

        // Force HTTPS connection if setted in settings so
        if (CONFIG['security']['https']) {
            $this->_https();
        }

        // Run HTTP Secure Transport Policy
        $this->_hsts(CONFIG['security']['hsts']);

        // Ensure that session is securely started
        $this->_secureSession();

        // Turn on error reporting depending on production switch
        $this->_errorReporting(!CONFIG['production']);

        // Start routing
        $this->Router = new Router;
        $file = $this->Router->getFileName();

        $wrapper = "$file.php";
        $template = "$file.twig";

        // Use renderer
        parent::_render($wrapper, $template);
    }

    /**
     * Ensures that app has loaded session safely.
     *
     * @return void
     */
    private function _secureSession(): void
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
     * Sets current to state error reporting style developer mode switch dependent.
     *
     * @param boolean $isProd flag is developer mode turned on
     *
     * @return void
     */
    private function _errorReporting(bool $isProd): void
    {
        if ($isProd) {
            // IF IN DEVELOPER MODE SHOW ALL ERRORS
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        } else {
            // ELSE IF IN PRODUCTION MODE HIDE ALL ERRORS
            error_reporting(0);
            ini_set('display_errors', 0);
        }
    }

    /**
     * Enforcing on app usage of HTTP Secure protocol instead of normal HTTP/
     *
     * If page is detected to run over HTTP only, page will be redirected to HTTPS. Run only on compatible servers, will cause problems if server does not offer HTTPS connections.
     *
     * @return void
     */
    private function _https(): void
    {
        if ($_SERVER['HTTPS'] !== "on") {
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            exit();
        }
    }

    /**
     * Set HSTS Header ahead
     *
     * @param bool $status
     */
    private function _hsts(bool $status): void
    {
        if ($status) {
            header('Strict-Transport-Security: max-age=16070400');
        } else {
            header('Strict-Transport-Security: max-age=0');
        }
    }
}
