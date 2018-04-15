<?php
/**
 * Enter here your project documentation
 *
 *
 * PHP version 7.2
 *
 * @category  <enter category>
 * @package   <enter package>
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright MIT License
 * @version   GIT:<git_id>
 * @link      <enter link>
 */

namespace DBLS\Model;

use \PDO as PDO;

/**
 * Full-working database class located in model-part of an app.
 *
 * Class that loads data from DB to controllers.
 *
 * @category  Model
 * @package   DatabaseByArchitektur
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      https://dbls.eu
 */
class Database
{

    /**
     * Represents an PDO object
     *
     * @var object
     */
    private $_database;

    /**
     * Keeps database credintials info from config file
     *
     * @var array
     */
    private $_credintials;

    /**
     * Class constructor that automatically loads config from external file
     *
     * @return void
     */
    public function __construct()
    {
        $this->_credintials = include "./config.php";
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
        if (empty($this->_database)) {
            $this->_database = new PDO(
                $this->_credintials['dbconfig']["dsn"],
                $this->_credintials['dbconfig']["usr"],
                $this->_credintials['dbconfig']["pswd"],
                $this->_credintials['dbconfig']["addInfo"]
            );

            $this->_database->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }
        $query = $this->_database->prepare($sql);
        $query->execute();

        switch ($action) {

            // Returning all data to associative array
            case "returnFetched":
                $fetched = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($fetched == null) {
                    return false;
                } else {
                    return $fetched;
                }

                break;

            // Returning only first entry to associative array
            case "returnOne":
                $fetched = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($fetched == null) {
                    return false;
                } else {
                    return $fetched[0];
                }

                break;

            // Returning true if instructions were made successfully
            case "expectingNoData":
                return true;
                break;

        }
    }
}
