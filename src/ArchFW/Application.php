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
        define('DEVMODE', $dev);

        if ($forceHTTPS) {
            $this->_https();
        }
        $this->_secureSession();
        
        $this->Router = new Router;
        $file = $this->Router->getFileName();

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
    public static function error(int $code, string $message, string $method)
    {
        http_response_code($code);
        switch ($method) {
            case 'html':
                $path = CONFIG['pathToErrorPages'] . "/$code.html";
                if (file_exists($path)) {
                    require_once $path;
                    die;
                } else {
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
