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
 * @version   2.6.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

/**
 * Created by PhpStorm.
 * User: Oskar Barcz
 * Date: 06.12.2018
 * Time: 00:39
 */

namespace ArchFW\Controllers;

use ArchFW\Exceptions\RouteNotFoundException;

/**
 * Class NewRouter
 *
 * @package ArchFW\Controllers
 */
class Router
{
    private $requestedUri;

    private static $routingPaths;

    private static $templateName;

    /**
     * NewRouter constructor.
     *
     * @param string $requestUri
     */
    public function __construct(string $requestUri)
    {
        // assing value
        $this->requestedUri = $requestUri;
        self::$routingPaths = explode('/', $requestUri);
    }

    /**
     * @return string
     * @throws RouteNotFoundException
     */
    public function getViewClassName(): string
    {
        $routingPaths = Config::get('routes', 'routingPaths');
        $adress = explode('/', $this->requestedUri);
        $prefix = Config::get(Config::SECTION_ROUTER, 'safeClassCalloutPath');
        // define api or not
        if ($this->isApi()) {
            // if match 'address' => class found in array
            if (array_key_exists($adress[2], $routingPaths['api'])) {
                $className = $routingPaths['api'][$adress[2]];
                $fqn = $prefix['api'] . '\\' . $className;
            } else {
                throw new RouteNotFoundException("Route {$adress[2]} has not been found in routes file!", 601);
            }
        } else {
            if (array_key_exists($adress[1], $routingPaths['application'])) {
                $className = $routingPaths['application'][$adress[1]]['class'];
                $fqn = $prefix['application'] . '\\' . $className;
            } else {
                throw new RouteNotFoundException("Route {$adress[1]} has not been found in routes file!", 601);
            }
        }
        self::$templateName = $routingPaths['application'][$adress[1]]['template'];
        return $fqn;
    }

    /**
     * @return bool Define whether using the API or application classes
     */
    private function isApi(): bool
    {
        return (strpos($this->requestedUri, '/api/') === 0);
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