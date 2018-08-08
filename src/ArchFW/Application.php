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
use ArchFW\Controller\Router;

/**
 * Representation of ArchFW Application
 *
 * Contains methods such error handling, routing securing session and ensuring security over HTTPS
 */
final class Application extends View
{
    /**
     * Holds pointer to application router
     *
     * @var Router
     */
    private $Router;

    public function __construct(array $appConfig, bool $forceHTTPS = true, bool $dev = false)
    {
        define('CONFIG', $appConfig); // LOADING CONFIG FILE AS CONSTANT

        if ($forceHTTPS) {
            $this->_https();
        }
        $this->_secureSession();
        
        $this->Router = new Router;
        $file = $this->Router->getFileName();

        $wrapper = "$file.php";
        $template = "$file.twig";

        parent::_render($wrapper, $template);
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
        if ($_SERVER["HTTPS"] !== "on") {
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            exit();
        }
    }
}
