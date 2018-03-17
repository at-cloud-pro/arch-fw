<?php
//KONTROLLER UŻYWANY DO DODAWANIA I LOGOWANIA UŻYTKOWNIKÓW (PowerAdmin)

class controller_users
{
    private $DATABASE;

    function __construct()
    {
        $this->DATABASE = new model_database();
    }

    public function CheckUserExists($login, $password)
    {
        $password_hashed = hash('sha256', $password);
        
        $sql = "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password_hashed';";
        $fromDatabase = $this->DATABASE->execute($sql, "returnFetched");
        if (count($fromDatabase)==1)
        {
            $fetched = $fromDatabase[0];
            $_SESSION['login'] = $fetched['login'];
            $_SESSION['name'] = $fetched['name'];
            $_SESSION['surname'] = $fetched['surname'];
            $_SESSION['role'] = $fetched['role'];
            $_SESSION['logged'] = true;
            return true;
        }
        else return false;
    }

    public function ChangePassword($userLogin, $newPassword)
    {
        $passwordHashed = hash('sha256', $newPassword);

        $sql = "UPDATE `users` SET `password`='$passwordHashed' WHERE `login`='$userLogin'; ";
        $fromDatabase = $this->DATABASE->execute($sql, "expectingNoData");
    }

    function __destruct()
    {
        $this->DATABASE = null;
    }

}
