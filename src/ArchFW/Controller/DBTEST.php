<?php

namespace ArchFW\Controller;

use ArchFW\Model\DatabaseFactory;


class DBTEST
{
    function dl()
    {
        $db = DatabaseFactory::getInstance();

        $data = $db->select("base", [
            "id",
            "name",
            "surname",
            "status"
        ]);

        return $data;
    }
}