<?php
class model_database
{
    protected $DATABASE;

    function execute($sql, $whatToDoWithData)
    {
        if (empty($this->credentials['dsn']))
        {
            $this->DATABASE = new PDO('mysql:host=127.0.0.1;dbname=','root','',array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ));
            $this->DATABASE->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        $query = $this->DATABASE->prepare($sql);
        $query->execute();

        switch ($whatToDoWithData)
        {
            case "returnFetched":
                $fetched = $query->fetchAll(PDO::FETCH_ASSOC);
                return $fetched;
                break;

            case "expectingNoData":
                return true;
                break;
        }
    }
}
