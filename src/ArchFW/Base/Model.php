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
