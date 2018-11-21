<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 *  @category  Framework/Boilerplate
 *  @package   ArchFW
 *  @author    Oskar Barcz <kontakt@archi-tektur.pl>
 *  @copyright 2018 Oskar 'archi_tektur' Barcz
 *  @license   MIT
 *  @version   2.6.0
 *  @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW;

use ArchFW\View\View;
use ArchFW\Controller\Config;
use ArchFW\Controller\Error;
use ArchFW\Controller\Router;
use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Exceptions\RouteNotFoundException;
use ArchFW\Model\ConfigFactory;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

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
     * Application constructor. Main method that is running selected classes, initiate session and router.
     *
     * @param string $configPath Contains path to config files
     */
    public function __construct(string $configPath)
    {
        try {
            // Load application configuration details as constant
            ConfigFactory::fill($configPath);


            // Force HTTPS connection if setted in settings so
            if (Config::get(Config::SECTION_APP, 'security')['https']) {
                $this->https();
            }

            // Run HTTP Secure Transport Policy
            $this->hsts(Config::get(Config::SECTION_APP, 'security')['hsts']);

            // Ensure that session is securely started
            $this->secureSession();

            // Turn on error reporting depending on production switch
            $this->errorReporting(!Config::get(Config::SECTION_APP, 'production'));

            // Start routing and rendering
            $Router = new Router($_SERVER['REQUEST_URI']);
            $Renderer = $Router->getRenderer();
            $page = $Renderer->render();

            // response
            print $page;


        } catch (RouteNotFoundException $e) {
            switch ($e->getCode()) {
                case 601:
                    $method = Error::JSON;
                    break;
                case 602:
                    $method = Error::JSON;
                    break;
                case 603:
                    $method = Error::JSON;
                    break;
                case 604:
                    $method = Error::PLAIN;
                    break;
                case 605:
                    $method = Error::HTML;
                    break;
                case 606:
                    $method = Error::PLAIN;
                    break;
                default:
                    $method = Error::HTML;
            }
            new Error(
                $e->getCode(),
                $e->getMessage(),
                $method
            );
        } catch (NoFileFoundException $e) {
            new Error(404, 'Config files not found', Error::PLAIN);
        } catch (NoFileFoundException $e) {
            new Error(404, $e->getMessage(), Error::PLAIN);
        } catch (Twig_Error_Loader $e) {
            new Error(500, $e->getMessage(), Error::PLAIN);
        } catch (Twig_Error_Runtime $e) {
            new Error(500, $e->getMessage(), Error::PLAIN);
        } catch (Twig_Error_Syntax $e) {
            new Error(500, $e->getMessage(), Error::PLAIN);
        }
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
