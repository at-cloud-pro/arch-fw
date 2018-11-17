<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.5.1
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW;

use ArchFW\Base\View;
use ArchFW\Controller\Error;
use ArchFW\Controller\Router;
use ArchFW\Exceptions\ArchFWException;
use ArchFW\Exceptions\RouteNotFoundException;

/**
 * Representation of ArchFW Application
 *
 * Contains methods such securing session and ensuring security over HTTPS.
 * It's also an app starter - constructor here does all stuff you need to run an app.
 * App will not check validity of vendor or config, so you have to do it separately.
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
     * @param string $configPath Contains path to config files
     */
    public function __construct(string $configPath)
    {
        // Load application configuration details as constant
        try {
            define('CONFIG', $this->loadConfig($configPath));
        } catch (ArchFWException $err) {
            new Error($err->getCode(), $err->getMessage(), Error::PLAIN);
        }


        // Force HTTPS connection if setted in settings so
        if (CONFIG['app']['security']['https']) {
            $this->https();
        }

        // Run HTTP Secure Transport Policy
        $this->hsts(CONFIG['app']['security']['hsts']);

        // Ensure that session is securely started
        $this->secureSession();

        // Turn on error reporting depending on production switch
        $this->errorReporting(!CONFIG['app']['production']);

        // Start routing
        try {
            $this->Router = new Router();
            $file = $this->Router->getFileName();

            $wrapper = "$file.php";
            $template = "$file.twig";

            // Use renderer
            parent::render($wrapper, $template);
        } catch (RouteNotFoundException $e) {
            switch ($e->getCode()) {
                case 601:
                    new Error(
                        601,
                        $e->getMessage(),
                        Error::JSON
                    );
                    break;

                case 602:
                    new Error(
                        404,
                        $e->getMessage(),
                        Error::JSON
                    );
                    break;
                case 603:
                    new Error(
                        404,
                        $e->getMessage(),
                        Error::JSON
                    );
                    break;

                case 604:
                    new Error(
                        404,
                        $e->getMessage(),
                        Error::PLAIN
                    );
                    break;

                case 605:
                    new Error(
                        404,
                        $e->getMessage(),
                        Error::HTML
                    );
                    break;

                case 606:
                    new Error(
                        404,
                        $e->getMessage(),
                        Error::PLAIN
                    );
                    break;
            }
        }
    }

    /**
     * Returns config array
     *
     * @param string $path
     * @throws ArchFWException when config files were not found
     *
     * @return array Application config files
     */
    private function loadConfig(string $path): array
    {
        $masterCfgPath = "{$path}/archsettings.php";
        $databaseCfgPath = "{$path}/database.php";
        $routesCfgPath = "{$path}/routes.php";

        if (file_exists($masterCfgPath)) {
            $applicationConfig = require $masterCfgPath;
        } else {
            throw new ArchFWException('No master config file found.', 404);
        }

        if (file_exists($databaseCfgPath)) {
            $databaseConfig = require $databaseCfgPath;
        } else {
            throw new ArchFWException('No database config file found.', 404);
        }

        if (file_exists($routesCfgPath)) {
            $routesConfig = require $routesCfgPath;
        } else {
            throw new ArchFWException('No routes config file found.', 404);
        }

        return [
            'app'      => $applicationConfig,
            'database' => $databaseConfig,
            'routes'   => $routesConfig,
        ];
    }

    /**
     * Enforcing on app usage of HTTP Secure protocol instead of normal HTTP/
     *
     * If page is detected to run over HTTP only, page will be redirected to HTTPS.
     * Run only on compatible servers, will cause problems if server does not offer HTTPS connections.
     *
     * @return void
     */
    private function https(): void
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
    private function hsts(bool $status): void
    {
        if ($status) {
            header('Strict-Transport-Security: max-age=16070400');
        } else {
            header('Strict-Transport-Security: max-age=0');
        }
    }

    /**
     * Ensures that app has loaded session safely.
     *
     * @return void
     */
    private function secureSession(): void
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
    private function errorReporting(bool $isProd): void
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
}
