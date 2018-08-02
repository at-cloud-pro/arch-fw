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

use \ArchFW\Base\Model;
use \PDO;

class Database extends Model
{

    /**
     * Represents an PDO object
     *
     * @var object
     */
    private $_database;

    public function __construct()
    {
        $this->_connect();
    }

    private function _connect()
    {
        if (empty($this->_database)) {
            $this->_database = new PDO(
                CONFIG['DBConfig']["dsn"],
                CONFIG['DBConfig']["usr"],
                CONFIG['DBConfig']["pswd"],
                CONFIG['DBConfig']["addInfo"]
            );
        }
    }

    /**
     * Main operative function, executes SQL queries on database
     *
     * Example of use: $object->execute("SELECT * FROM tablename","returnFetched");
     *
     * @param string $sql    Contains SQL Query
     * @param string $action Allows users to choose what to do
     *                       with data returned from query from
     *                       options:
     *
     * @return array|bool Assiociative array with fetched elements from database,
     *                    returning false when nothing found
     */
    public function execute(string $sql, string $action)
    {
        $this->_connect();
        $query = $this->_database->prepare($sql);
        $query->execute();

        if ($action == "expectingNoData") {
            return true;
        } else {
            return parent::ReturnValues($action, $query);
        }
    }

    /**
     * Magic method shows whitch properties WILL be serialized.
     *
     * @return array
     */
    public function __sleep()
    {
        return ['_credintials'];
    }

    /**
     * Magic method that is telling what is going to be done after unserialize() function
     */
    public function __wakeup()
    {
        $this->_connect();
    }

}
