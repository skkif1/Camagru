<?php

require_once (root . "/DAO/UserDao.php");
require_once (root . "/DAO/MySqlConnection.php");
require_once (root . "/Entity/User.php");

class UserImpl implements UserDao
{

    private $connection;

    public function __construct()
    {
        $this->connection = new MySqlConnection();
        $this->connection = $this->connection->getConnection();
    }

    public function getUserbyId($Id)
    {
        $stm = $this->connection->prepare("select * from camagru.user");
        $stm->execute();
    }

    public function saveUser(User $user)
    {
        echo "save";
        $hash = password_hash($user->getPassword() . 'camagru', PASSWORD_BCRYPT);
        $stm = $this->connection->prepare(
                                            "INSERT INTO camagru.user (login, password, email, hash)
                                            VALUES(?, ?, ?, ?)");
        var_dump($user);
        $stm->execute(array($user->getLogin(), $user->getPassword(), $user->getEmail(), $hash));
        echo "save";
    }
}