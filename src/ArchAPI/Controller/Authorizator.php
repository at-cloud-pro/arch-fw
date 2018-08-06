<?php

namespace ArchAPI\Controller;

use ArchFW\Application;

abstract class Authorizator implements IAuthorizator
{
    /**
     * Flag with information is user allowed to access or not/
     *
     * @var boolean
     */
    protected $_isValid;

    /**
     * Method chosen to provide errors, JSON by default.
     *
     * @var string
     */
    protected $_method;

    public function __construct(string $region, string $method = 'json')
    {
        if($method === "json" OR $method === "html" OR $method === "plain"){
            // validate if string is correct
            $this->_method = $method;
        } else {
            // set one method if is not correct
            $this->_method = 'plain';
        }

        $this->_isValid = null;
        if(!empty($crd = $this->getCredintials($region))) {
            $this->_validate($crd);
        } else Application::error(500, "No method to authorize!", $this->_method);

    }

    /**
     * Uses APIAuth Object to authorize access to app.
     *
     * @param array $userList with logins and passwords
     * @return void
     */
    protected function _validate(array $userList)
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            // if BasicAuth username were not given, throw headers with WWW-Authenticate
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('Cache-Control: no-cache, must-revalidate, max-age=0');
            Application::error(401, "Unauthorized", $this->_method);
        } else {
            // else use APIAuth to authorize access
            $log = new APIAuth($userList);

            if($log->authorize()){
                $this->_isValid = true;
            } else {
                $this->_isValid = false;
                $this->_deny();
            }
        }
    }

    /**
     * Returns array with user logins and passwords
     *
     * @return array with logins and passwords
     */
    abstract public function getCredintials(string $region) : array;

    /**
     * Throws re-validate header and visible (or not) error
     *
     * @return void
     */
    protected function _deny()
    {
        header('WWW-Authenticate: Basic realm="Access denied"');
        Application::error(401, "Unauthorized", $this->_method);
    }
}