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

namespace ArchFW\Base;


/**
 * Abstract controller class that is creating Database connection object on creation and destroys it on object dissapearing.
 */
abstract class Controller
{

    /**
     * Keeps a handler to a database connection object.
     *
     * @var object
     */
    protected $_database;

    public function __construct()
    {
        $this->_database = new \ArchFW\Model\Database([
            'database_type' => CONFIG['DBConfig']['databaseType'],
            'database_name' => CONFIG['DBConfig']['databaseName'],
            'server' => CONFIG['DBConfig']['server'],
            'username' => CONFIG['DBConfig']['user'],
            'password' => CONFIG['DBConfig']['password']
        ]);
    }

    public function __wakeup()
    {
        $this->_database = new \ArchFW\Model\Database([
            'database_type' => CONFIG['DBConfig']['databaseType'],
            'database_name' => CONFIG['DBConfig']['databaseName'],
            'server' => CONFIG['DBConfig']['server'],
            'username' => CONFIG['DBConfig']['user'],
            'password' => CONFIG['DBConfig']['password']
        ]);
    }

}
