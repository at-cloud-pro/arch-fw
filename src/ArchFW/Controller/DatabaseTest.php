<?php

namespace ArchFW\Controller;
use ArchFW\Base\Controller;

class DatabaseTest extends Controller
{
    function dl()
    {
        $data = $this->_database->select("base", [
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