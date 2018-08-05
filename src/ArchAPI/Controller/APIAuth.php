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

namespace ArchAPI\Controller;

class APIAuth
{
    private $_username;
    private $_password;

    private $_userlist;

    public function __construct(array $userlist)
    {
        $this->_username = $_SERVER['PHP_AUTH_USER'];
        $this->_password = $_SERVER['PHP_AUTH_PW'];
        $this->_userlist = $userlist;
    }

    public function authorize()
    {
        if(array_key_exists($_SERVER['PHP_AUTH_USER'], $this->_userlist)){
            // if userlist contains given username
            if($this->_userlist[$_SERVER['PHP_AUTH_USER']] === $_SERVER['PHP_AUTH_PW']){
                return true;
            } else {
                return false;
            }
        }
    }
}