<?php
/**
 * Enter here your project documentation
 *
 *
 * PHP version 7.2
 *
 * @category  <enter category>
 * @package   <enter package>
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright MIT License
 * @version   GIT:<git_id>
 * @link      <enter link>
 */

namespace FRAMEWORK\Controller;

/**
 * Simple easy to extend class with basic user authentication
 */
class Users
{
    private $DATABASE;

    public function __construct()
    {
        $this->DATABASE = new \FRAMEWORK\Model\Database;
    }

    public function checkUserExists($login, $password, $encrypted)
    {
        if ($encrypted) {
            $passwordHashed = $password;
        } else {
            $passwordHashed = hash('sha256', $password);
        }

        $sql = "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$passwordHashed';";
        $fromDatabase = $this->DATABASE->execute($sql, "returnOne");
        if (!empty($fromDatabase)) {
            $fetched = $fromDatabase;
            $_SESSION['login'] = $fetched['login'];
            $_SESSION['name'] = $fetched['name'];
            $_SESSION['surname'] = $fetched['surname'];
            $_SESSION['acc_lvl'] = $fetched['acc_lvl'];
            $_SESSION['passwordEncrypted'] = $fetched['password'];
            return true;
        } else {
            return false;
        }

    }

    public function changePassword($userLogin, $newPassword)
    {

        $sql = "UPDATE `users` SET `password`='$passwordHashed' WHERE `login`='$userLogin'; ";
        $fromDatabase = $this->DATABASE->execute($sql, "expectingNoData");
    }

    public function __destruct()
    {
        $this->DATABASE = null;
    }

}
