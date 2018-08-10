<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
 *
 * Visit https://github.com/okbrcz/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   4.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */
namespace ArchFW\Model;

/**
 * Factory is creating new Database handler with pre-installed configuration
 *
 * @package ArchFW\Model
 */
final class DatabaseFactory
{
    /**
     * Getting brand new instance of Database object, with loaded config given in config.cfg file.
     *
     * @return Database Returns database object with config given
     */
    final public static function getInstance()
    {
        return new Database([
            'database_type' => CONFIG['DBConfig']['databaseType'],
            'database_name' => CONFIG['DBConfig']['databaseName'],
            'server' => CONFIG['DBConfig']['server'],
            'username' => CONFIG['DBConfig']['user'],
            'password' => CONFIG['DBConfig']['password'],
        ]);
    }
}
