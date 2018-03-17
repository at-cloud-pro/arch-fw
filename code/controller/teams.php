<?php
//KONTROLLER UŻYWANY DO DODAWANIA I SPISYWANIA DRUŻYN :D

class controller_teams
{
    private $MODEL;

    function __construct()
    {
        $this->MODEL = new model_database();
    }

    public function addTeam($teamData)
    {

        $game           = $teamData['game'];
        $teamName       = $teamData['teamName'];
        $email          = $teamData['email'];
        $phone          = $teamData['phone'];
        $voivodeship    = $teamData['voivodeship'];
        $city           = $teamData['city'];
        $teamCapitan    = $teamData['teamCapitan'];
        $player2        = $teamData['player2'];
        $player3        = $teamData['player3'];
        $player4        = $teamData['player4'];
        $player5        = $teamData['player5'];
        $reserve1       = $teamData['reserve1'];
        $reserve2       = $teamData['reserve2'];

        $sql = "INSERT INTO `teams` (`id`, `game`, `teamName`, `email`, `phone`, `voivodeship`, `city`, `capitan`, `gamer2`, `gamer3`, `gamer4`, `gamer5`, `optional1`, `optional2`, `comments`) VALUES (NULL, '$game', '$teamName', '$email', '$phone', '$voivodeship', '$city', '$teamCapitan', '$player2', '$player3', '$player4', '$player5', '$reserve1', '$reserve2', NULL);";

        $this->MODEL->execute($sql, "expectingNoData");
    }

    public function getTeamDetails($id)
    {
        $sql = "SELECT * FROM `teams` WHERE `id`='$id';";
        $fetched = $this->MODEL->execute($sql, "returnFetched");
        return $fetched;
    }

    public function getAllTeamsDetails($game)
    {
        $sql = "SELECT * FROM `teams` WHERE `game`='$game';";
        $fetched = $this->MODEL->execute($sql, "returnFetched");
        return $fetched;
    }
}
