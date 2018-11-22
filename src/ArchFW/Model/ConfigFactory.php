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

namespace ArchFW\Model;

use ArchFW\Controller\Config;
use ArchFW\Exceptions\NoFileFoundException;

/**
 * Class ConfigFactory loads file arrays to initial Config object
 *
 * @package ArchFW\Model
 */
class ConfigFactory
{

    /**
     * Consts for easier file path configuration
     */
    private const FILENAME_APP = 'archsettings.php';
    private const FILENAME_DB = 'database.php';
    private const FILENAME_ROUTER = 'routes.php';

    /**
     * Fill the config object with datas from file
     *
     * @param string $path
     * @throws NoFileFoundException when
     */
    public static function fill(string $path)
    {

        // generate paths
        $masterCfgPath = $path . '/' . self::FILENAME_APP;
        $databaseCfgPath = $path . '/' . self::FILENAME_DB;
        $routesCfgPath = $path . '/' . self::FILENAME_ROUTER;

        // load files
        if (file_exists($masterCfgPath) and file_exists($routesCfgPath) and file_exists($databaseCfgPath)) {
            $applicationConfig = require $masterCfgPath;
            $databaseConfig = require $databaseCfgPath;
            $routesConfig = require $routesCfgPath;
        } else {
            throw new NoFileFoundException('No master config file found.', 404);
        }

        // fill initial object
        Config::setAll(Config::SECTION_APP, $applicationConfig);
        Config::setAll(Config::SECTION_DB, $databaseConfig);
        Config::setAll(Config::SECTION_ROUTER, $routesConfig);
    }
}
