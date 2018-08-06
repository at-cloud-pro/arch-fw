<?php

namespace ArchAPI\Controller;

/**
 * IAuthorizator extort usage of getCredintials method in developer's written Authorizator class extention (child).
 */
interface IAuthorizator
{
    /**
     * Returns array with user logins and passwords
     *
     * @return array with logins and passwords
     */
    function getCredintials() : array;
}