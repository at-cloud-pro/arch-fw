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

namespace ArchFW\Models;

use ArchFW\Controllers\Config;
use Medoo\Medoo;

/**
 * Factory is creating new Database handler with pre-installed configuration
 *
 */
final class DatabaseFactory
{
    /**
     * Getting brand new instance of Database object, with loaded config given in config.cfg file.
     *
     * @return Medoo Returns database object with config given
     */
    public static function getInstance(): Medoo
    {
        return new Medoo(
            [
                'database_type' => Config::get(Config::SECTION_DB, 'databaseType'),
                'database_name' => Config::get(Config::SECTION_DB, 'databaseName'),
                'server'        => Config::get(Config::SECTION_DB, 'server'),
                'username'      => Config::get(Config::SECTION_DB, 'user'),
                'password'      => Config::get(Config::SECTION_DB, 'password')
            ]
        );
    }
}
