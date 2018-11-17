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

namespace ArchFW\Controller;

use ArchFW\Exceptions\RouteNotFoundException;

/**
 * Retrieves requested URI into file wrappers, sets GET variables, switching between api and html mode easily.
 */
final class Router
{
    /**
     * Function for assigning wrappers and templates depending on URI
     *
     * Depending on URI returns API wrappers or TWIG Templates and PHP Wrappers
     *
     * @return string filename that has to be loaded
     * @throws RouteNotFoundException
     */
    public function getFileName(): string
    {
        // CHECK IF APP HAS
        $uri = explode(
            '?',
            $_SERVER['REQUEST_URI']
        );
        if (array_key_exists(1, $uri)) {
            $_GET = $this->findArgs($uri[1]);
        }

        if (strpos($_SERVER['REQUEST_URI'], '/api/') !== false) {
            return $this->findFiles($uri[0], true);
        }
        return $this->findFiles($uri[0], false);
    }

    /**
     * Returns array of GET values in URI
     *
     * Simple gets all data after '?', then puts it in an array. Required if
     * using REST style routing. Run function and assing returned values to $_GET variable.
     *
     * @param string $string
     * @return array
     */
    private function findArgs(string $string): array
    {
        $args = explode('&', $string);
        $output = [];

        if (count($args) > 0) {
            foreach ($args as $key => $value) {
                $str = explode('=', $value);
                if (array_key_exists(1, $str)) {
                    $output += [$str[0] => $str[1]];
                } elseif ($str[0] != "") {
                    $output += [$str[0] => null];
                }
            }
        }
        return $output;
    }

    /**
     * Finds file name for specified URI
     *
     * Function is checking if in config file is specified which file app should load
     * when user enters specified URI. By default looking for twig templates,
     * if $isAPI variable is set to true, only loads API wrapper.
     *
     * @param string $string Requested URI file part
     * @param boolean $isAPI Set to true when accessing API server
     * @return string Returns filename when found
     * @throws RouteNotFoundException
     */
    private function findFiles(string $string, bool $isAPI): string
    {
        $explodedURI = (explode("/", $string));

        // delete first key, it's always empty because given string has /*/* format
        array_shift($explodedURI);
        // set URI parts as constant array
        define('ROUTER', $explodedURI);


        // Looking in API router
        if ($isAPI) {
            // RUNS IF SERVER MAY BE USED AS API SERVO
            if (CONFIG['app']['APIrunning'] === false) {
                throw new RouteNotFoundException(
                    'API functionality were turned off in app config file on server.',
                    601
                );
            }
            if (!array_key_exists('/' . $explodedURI[1], CONFIG['routes']['APIrouter'])) {
                throw new RouteNotFoundException(
                    "Router did not found route '/{$explodedURI[1]}' in API config file!",
                    602
                );
            }

            $file = CONFIG['app']['APIwrappers'] . "/" . CONFIG['routes']['APIrouter']['/' . $explodedURI[1]];
            if (!file_exists("$file.php")) {
                throw new RouteNotFoundException(
                    "Wrapper file does not exist or no access!",
                    603
                );

            }
            $json = require_once "$file.php";
            echo json_encode($json);
            exit;
            // Looking in APP router
        } elseif (!array_key_exists('/' . $explodedURI[0], CONFIG['routes']['APProuter'])) {
            // if no router key contains URL
            if ($route = CONFIG['routes']['redirectOnNoMatch'] and $route) {
                if (isset($_SESSION['catchInfLoop']) and $_SESSION['catchInfLoop'] === true) {
                    $_SESSION['catchInfLoop'] = false;
                    throw new RouteNotFoundException(
                        'RedirectOnMatch adress does not have assigned route path.',
                        606
                    );
                }
                $_SESSION['catchInfLoop'] = true;
                header("Location: {$route}");
                exit();
            } elseif (!CONFIG['app']['production']) {
                throw new RouteNotFoundException(
                    "Router did not found route '/{$explodedURI[0]}' in APP config file!",
                    604
                );
            }
            throw new RouteNotFoundException(
                "Not found",
                605
            );
        }
        return CONFIG['routes']['APProuter']['/' . $explodedURI[0]];
    }
}

