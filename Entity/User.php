<?php

class User
{
    private $id;
    private $email;
    private $password;
    private $login;

    public function __construct($email, $password, $login)
    {
        echo $email . "<br>";
        echo $password . "<br>";
        echo $login . "<br>";

        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }
}