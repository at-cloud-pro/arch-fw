<?php

namespace ArchAPI\Controller;

use ArchFW\Application;

abstract class Authorizator implements IAuthorizator
{
    protected $_isValid;

    protected $_method;

    public function __construct(string $region, string $method = 'json')
    {
        if($method === "json" OR $method === "html" OR $method === "plain"){
            $this->_method = $method;
        } else {
            $this->_method = 'plain';
        }

        $this->_isValid = null;
        if(!empty($crd = $this->getCredintials($region))) {
            $this->_validate($crd);
        } else Application::error(500, "No method to authorize!", $this->_method);

    }

    protected function _validate(array $userList)
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('Cache-Control: no-cache, must-revalidate, max-age=0');
            Application::error(401, "Unauthorized", $this->_method);
        } else {
            $log = new APIAuth($userList);

            if($log->authorize()){
                $this->_isValid = true;
            } else {
                $this->_isValid = false;
                $this->_deny();
            }
        }
    }

    abstract public function getCredintials();


    protected function _deny()
    {
        header('WWW-Authenticate: Basic realm="Access denied"');
        Application::error(401, "Unauthorized", $this->_method);
    }
}