<?php

namespace ArchFW\Controller;

use ArchFW\Factory\DatabaseFactory;


class DBTEST
{
    function dl()
    {
        $db = DatabaseFactory::getDBInstance();

        $data = $db->select("base", [
            "id",
            "name",
            "surname",
            "status"
        ], [
            "id[>]" => 10
        ]);

        return $data;
    }
}