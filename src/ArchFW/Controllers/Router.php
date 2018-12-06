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
 * @author    Oskar 'archi-tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */


namespace ArchFW\Controllers;

use ArchFW\Exceptions\RouteNotFoundException;
use function array_key_exists;
use function array_shift;
use function explode;

/**
 * Class NewRouter
 *
 * @package ArchFW\Controllers
 */
class Router
{
    private $requestedUri;

    private $isApi;

    private static $routingPaths;

    private static $templateName;

    /**
     * NewRouter constructor.
     *
     * @param string $requestUri
     */
    public function __construct(string $requestUri)
    {
        // chop values into like ADRESS ? GET VARIABLES
        $expl = explode('?', $requestUri);
        $requestDirs = $expl[0];
        $routes = explode('/', $requestDirs);

        // delete /api/ from API routers
        if ($this->isApi($requestDirs)) {
            array_shift($routes);
        }

        // assign
        self::$routingPaths = $routes;
        $this->requestedUri = $requestDirs;

        // Assign GET style values to proper superglobal variable
        if (array_key_exists(1, $expl)) {
            // Assign it if has
            $_GET = $this->findArgs($expl[1]);
        }
    }

    /**
     * @return string
     * @throws RouteNotFoundException
     */
    public function getViewClassName(): string
    {
        $routingPaths = Config::get('routes', 'routingPaths');
        $address = self::$routingPaths[1];
        $prefix = Config::get(Config::SECTION_ROUTER, 'safeClassCalloutPath');

        // select where to look for
        $key = ($this->isApi) ? 'api' : 'application';

        // define template name if needeed
        if (!$this->isApi) {
            self::$templateName = $routingPaths[$key][$address]['template'];
        }

        // if match 'address' => class found in array
        if (array_key_exists($address, $routingPaths[$key])) {
            if ($this->isApi) {
                // class name if API
                $className = $routingPaths[$key][$address];
            } else {
                // class and template name if application
                self::$templateName = $routingPaths[$key][$address]['template'];
                $className = $routingPaths[$key][$address]['class'];
            }
            $fqn = $prefix[$key] . '\\' . $className;
        } else {
            throw new RouteNotFoundException("Route {$address} has not been found in routes file!", 601);
        }

        return '\\' . $fqn;
    }

    /**
     * @param string $requestDir
     * @return bool Define whether using the API or application classes
     */
    private function isApi(string $requestDir): bool
    {
        $this->isApi = (strpos($requestDir, '/api/') === 0);
        return $this->isApi;
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
            foreach ($args as $arg) {
                $str = explode('=', $arg);
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
     * Get nth element of URL in cute adresses (exploded by "/")
     *
     * @param int $index
     * @return string
     */
    public static function getNthURI(int $index): string
    {
        return self::$routingPaths[$index] ?? '';
    }

    /**
     * Get nth element of URL in cute adresses (exploded by "/")
     *
     * @return array
     */
    public static function getAllURI(): array
    {
        return self::$routingPaths;
    }

    /**
     * @return string
     */
    public static function getTemplateName(): string
    {
        return self::$templateName;
    }

}