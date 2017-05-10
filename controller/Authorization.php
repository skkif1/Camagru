<?php

require_once (root . "/DAO/UserImpl.php");

class Authorization
{
    public function signUp($user)
    {
        var_dump($user);
        echo "Auth<br>";
        $toMySql = new UserImpl();
        $toMySql->saveUser($user);
    }

    public function login($login, $password)
    {
        echo "login";
    }

    public function logout()
    {
        echo "logout";
    }

    public function restorePassword()
    {
        echo "restorePass";
    }

    public function resetPassword()
    {
        echo "reser";
    }

}