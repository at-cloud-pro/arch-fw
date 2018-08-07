<?php

namespace ArchAPI\Model;

class APIClientLogger
{

    private $_login;

    private $_password;

    private $_server;

    private $_auth;

    public function __construct(string $login, string $password, string $server)
    {
        $this->_login = $login;
        $this->_password = $password;
        $this->_server = $server;
        $this->_auth = base64_encode("$login:$password");
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getServer()
    {
        return $this->_server;
    }

    public function getCalcHash()
    {
        return $this->_auth;
    }

}
