<?php

require_once (root . "/controller/Authorization.php");
require_once (root . "/Entity/User.php");

class LoginController
{
    public function process()
    {
        if (isset($_POST['auth']))
        {
            var_dump($_POST);
            $action = new Authorization();
            $user = new User($_POST['email'], $_POST['password'], $_POST['login']);
            echo "created user <br>";
            var_dump($user);
            $action->signUp($user);
        }
        else
            echo "404 not found";
    }
}