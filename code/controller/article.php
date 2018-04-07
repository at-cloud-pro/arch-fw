<?php 
class controller_article
{
    private $MODEL;

    function __construct()
    {
        $this->MODEL = new model_database;
    }

    public function getArticleByName($name)
    {
        $sql = "SELECT * FROM `articles` WHERE `friendlyName`='$name';";
        $fetched = $this->MODEL->execute($sql, "returnFetched");
        if (count($fetched) == 1) return $fetched[0];
        else return false;
    }

}

