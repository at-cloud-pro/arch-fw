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

namespace ArchFW\Controller;

use ArchFW\Exceptions\RouteNotFoundException;
use ArchFW\Interfaces\Renderable;
use ArchFW\View\Renderers\HTMLRenderer;
use ArchFW\View\Renderers\JSONRenderer;

/**
 * Retrieves requested URI into file wrappers, sets GET variables, switching between api and html mode easily.
 */
final class Router
{
    private $requestURI;

    private $fileName;

    private $isAPI;

    /**
     * Router constructor.
     *
     * @param $requestURI
     * @throws RouteNotFoundException
     */
    public function __construct($requestURI)
    {
        // Assign values
        $this->requestURI = $requestURI;

        // Check if adress has GET attribues
        $uri = explode('?', $requestURI);
        if (array_key_exists(1, $uri)) {
            // Assign it if has
            $_GET = $this->findArgs($uri[1]);
        }

        // Check where to look for mapping
        if (strpos($requestURI, '/api/') === 0) {
            // when requestURI is API uri
            $this->isAPI = true;
            $this->fileName = $this->findAPIWrappers($uri[0]);
        } else {
            // when requestURI is HTML uri
            $this->isAPI = false;
            $this->fileName = $this->findAPPWrappers($uri[0]);
        }
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
                } elseif ($str[0] != '') {
                    $output += [$str[0] => null];
                }
            }
        }
        return $output;
    }

    /**
     * Find app files in routes configuration file
     *
     * @param string $name
     * @return string
     * @throws RouteNotFoundException
     */
    private function findAPPWrappers(string $name): string
    {
        $explodedURI = (explode("/", $name));

        // delete first key, it's always empty because given string has /*/* format
        array_shift($explodedURI);
        // set URI parts as constant array
        define('ROUTER', $explodedURI);

        // if no route found
        if (!array_key_exists('/' . $explodedURI[0], Config::get(Config::SECTION_ROUTER, 'APProuter'))) {
            // if redirectOnNoMatch were set
            if ($route = Config::get(Config::SECTION_ROUTER, 'redirectOnNoMatch') and $route) {
                // catch possible recurse usage, throw an error then
                if (isset($_SESSION['catchInfLoop']) and $_SESSION['catchInfLoop'] === true) {
                    $_SESSION['catchInfLoop'] = false;
                    throw new RouteNotFoundException(
                        'RedirectOnMatch adress does not have assigned route path.',
                        606
                    );
                }
                $_SESSION['catchInfLoop'] = true;

                // redirect to route
                header("Location: {$route}");
                exit();
            } elseif (!Config::get(Config::SECTION_APP, 'production')) {
                // if route weren't found and redirectOnNoMatch wasn't set and developer mode is on
                throw new RouteNotFoundException(
                    "Router did not found route '/{$explodedURI[0]}' in APP config file!",
                    604
                );
            }
            // if route isn't found and production mode is turned on
            throw new RouteNotFoundException(
                "Not found",
                605
            );
        } else {
            // return path if found
            return Config::get(Config::SECTION_ROUTER, 'APProuter')['/' . $explodedURI[0]];
        }
    }

    /**
     * Find API files in routes configuration file
     *
     * @param string $name
     * @return string
     * @throws RouteNotFoundException
     */
    private function findAPIWrappers(string $name): string
    {
        $explodedURI = (explode("/", $name));

        // delete first key, it's always empty because given string has /*/* format
        array_shift($explodedURI);
        // set URI parts as constant array
        define('ROUTER', $explodedURI);

        // check if API is turned on in config
        if (!Config::get(Config::SECTION_APP, 'APIrunning')) {
            throw new RouteNotFoundException(
                'API functionality were turned off in app config file on server.',
                601
            );
        }

        // check if path exists, if no throw an exception
        if (!array_key_exists('/' . $explodedURI[1], Config::get(Config::SECTION_ROUTER, 'APIrouter'))) {
            throw new RouteNotFoundException(
                "Router did not found route '/{$explodedURI[1]}' in API config file!",
                602
            );
        }

        // return path if exists
        return Config::get(Config::SECTION_APP, 'APIwrappers')
            . '/' .
            Config::get(Config::SECTION_ROUTER, 'APIrouter')['/' . $explodedURI[1]];
    }

    /**
     * Method returns proper renderer depending on content
     *
     * @return Renderable returns renderer to be used
     * @throws \ArchFW\Exceptions\NoFileFoundException
     */
    public function getRenderer(): Renderable
    {
        if ($this->isAPI) {
            return new JSONRenderer($this->fileName);
        } else {
            return new HTMLRenderer($this->fileName);
        }
    }
}
