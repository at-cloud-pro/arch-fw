<?php


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
        $this->_credintials = include "./config.php";
        $this->_connect();
    }

    private function _connect()
    {
        if (empty($this->_database)) {
            $this->_database = new PDO(
                $this->_credintials['dbconfig']["dsn"],
                $this->_credintials['dbconfig']["usr"],
                $this->_credintials['dbconfig']["pswd"],
                $this->_credintials['dbconfig']["addInfo"]
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
