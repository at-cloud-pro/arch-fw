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
 * @version   2.8.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Models;

use ArchFW\Controllers\Config;
use ArchFW\Exceptions\NoFileFoundException;
use function file_exists;
use const DIRECTORY_SEPARATOR;

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
     * @throws NoFileFoundException
     */
    public static function fill(string $path): void
    {

        // generate paths
        $masterCfgPath = $path . DIRECTORY_SEPARATOR . self::FILENAME_APP;
        $databaseCfgPath = $path . DIRECTORY_SEPARATOR . self::FILENAME_DB;
        $routesCfgPath = $path . DIRECTORY_SEPARATOR . self::FILENAME_ROUTER;

        // load files
        if (file_exists($masterCfgPath) && file_exists($routesCfgPath) && file_exists($databaseCfgPath)) {
            /** @noinspection PhpIncludeInspection */
            $applicationConfig = include $masterCfgPath;
            /** @noinspection PhpIncludeInspection */
            $databaseConfig = include $databaseCfgPath;
            /** @noinspection PhpIncludeInspection */
            $routesConfig = include $routesCfgPath;
        } else {
            throw new NoFileFoundException('No master config file found.');
        }

        // fill initial object
        Config::setAll(Config::SECTION_APP, $applicationConfig);
        Config::setAll(Config::SECTION_DB, $databaseConfig);
        Config::setAll(Config::SECTION_ROUTER, $routesConfig);
    }
}
