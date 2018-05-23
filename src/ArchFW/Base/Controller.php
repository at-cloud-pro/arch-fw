<?php
/**
 * DBLS - Deutsche Bahn Lokfuhrer Seite - application made for TS2017
 *
 * This page were made for school project and for Train Simulator
 * 2017 purposes. This page has no affilation and never had any
 * with Deutsche Bahn AG.
 * Well, application is made for printing train drive schedule,
 * track distant signalling and other details to make Train
 * Simulator 2017 even more real.
 * I am in possibility to share access to this app, for that please
 * contact me by form available at the bottom of the
 * www.archi-tektur.pl page.
 *
 * PHP version 7.2
 *
 * @category  Transport
 * @package   DBLS
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   3.0
 * @link      https://dbls.eu
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
        $this->_database = new \ArchFW\Model\Database;
    }

    public function __wakeup()
    {
        $this->_database = new \ArchFW\Model\Database;

    }

}
