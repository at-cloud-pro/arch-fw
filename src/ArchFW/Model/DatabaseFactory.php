<?php

namespace ArchFW\Model;

use \ArchFW\Model\Database;

class DatabaseFactory
{
    public static function getInstance()
    {
        return new \ArchFW\Model\Database([
            'database_type' => CONFIG['DBConfig']['databaseType'],
            'database_name' => CONFIG['DBConfig']['databaseName'],
            'server' => CONFIG['DBConfig']['server'],
            'username' => CONFIG['DBConfig']['user'],
            'password' => CONFIG['DBConfig']['password']
        ]);
    }
}