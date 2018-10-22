<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   4.0.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchAPI\Controller;

/**
 * Instance of this class compares credintials given from developer written class with user-entered from browser's Basic Auth. You will probably have no need to use or extend this class.
 */
final class APIAuth
{

    /**
     * Holds BasicAuth username
     *
     * @var string
     */
    private $_username;

    /**
     * Holds BasicAuth password
     *
     * @var string
     */
    private $_password;

    /**
     * Holds array with possible logins and passwords given from developer
     *
     * @var array
     */
    private $_userlist;

    /**
     * Class constructor copy data from superglobal BasicAuth array and given array of usernames and passwords.
     *
     * @param array $userlist Given array of usernames and passwords
     */
    final public function __construct(array $userlist)
    {
        $this->_username = $_SERVER['PHP_AUTH_USER'];
        $this->_password = $_SERVER['PHP_AUTH_PW'];
        $this->_userlist = $userlist;
    }

    /**
     * Function try to find user and password that match with array given for constructor.
     *
     * @return boolean true if success, false if fail
     */
    final public function authorize(): bool
    {
        if (array_key_exists($_SERVER['PHP_AUTH_USER'], $this->_userlist)) {
            // if userlist contains given username
            if ($this->_userlist[$_SERVER['PHP_AUTH_USER']] === $_SERVER['PHP_AUTH_PW']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
}
