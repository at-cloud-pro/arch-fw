<?php
/**
 * Project title
 * 
 * Longer project description
 * 
 * PHP version 7.2
 * 
 * @category  Cateogry
 * @package   AppName
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   URL http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT:<git_id>
 * @link      URL link
 */

class Controller_Application
{
    /**
     * Keeps page meta info from config file
     *
     * @var array
     */
    private $_meta;

    /**
     * Class constructor that automatically loads config from external file
     * 
     * @param string $pageTitle If specified will change default page title into this. If not, will use default from file
     * 
     * @return void
     */
    function __construct($pageTitle=null)
    {
        $this->_meta = include_once "./appconfig.php";
    }

    /**
     * Returning array of page details
     *
     * @return void
     */
    public function getPageDetails()
    {
        return $this->_meta;
    }
}
