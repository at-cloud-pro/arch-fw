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
 * @version   4.0.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Model;

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
    final public static function getInstance()
    {
        return new Medoo(
            [
                'database_type' => CONFIG['database']['databaseType'],
                'database_name' => CONFIG['database']['databaseName'],
                'server'        => CONFIG['database']['server'],
                'username'      => CONFIG['database']['user'],
                'password'      => CONFIG['database']['password'],
            ]
        );
    }
}
