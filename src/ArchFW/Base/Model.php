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
 * Abstract class that loads data from external sources to program.
 */

abstract class Model
{

    /**
     * Keeps database credintials info from config file
     *
     * @var array
     */
    protected $_credintials;
    /**
     * Class constructor that automatically loads config from external file.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_credintials = include "./config.php";
    }

    public function __sleep()
    {
        return ['_credintials'];
    }

    /**
     * Universal method that is returning values to main scope.
     *
     * @param string $action Select from diffrent returning modes
     * * `returnFetched` - Returning all data to associative array.
     * * `returnOne` - Returning only first entry to associative array.
     * * `expectNoData` - Returns true when success and false if not.
     *
     * @param mixed $values Values to return.
     *
     * @return mixed Returning different values basing on `$action` selector.
     */
    protected function ReturnValues($action, $values)
    {
        switch ($action) {
            case "returnFetched":
                $fetched = $values->fetchAll(\PDO::FETCH_ASSOC);
                if ($fetched == null) {
                    return false;
                } else {
                    return $fetched;
                }
                break;

            case "returnOne":
                $fetched = $values->fetchAll(\PDO::FETCH_ASSOC);
                if ($fetched == null) {
                    return false;
                } else {
                    return $fetched[0];
                }
                break;
        }
    }
}
