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

    public function getUserbyEmail($email)
    {
        $stm = $this->connection->prepare("select * from camagru.user WHERE email = ?");
        $stm->execute(array($email));
        if (!$rs = $stm->fetch(PDO::FETCH_ASSOC))
            throw new InvalidArgumentException("Invalid email");
        $user = new User($rs['email'], $rs['password'], $rs['login'], $rs['id']);
        $user->setHash($rs['hash']);
        $user->setConfirm($rs['confirm']);
        return $user;
    }

    public function getUserbyLogin($login)
    {
        $stm = $this->connection->prepare("select * from camagru.user WHERE login = ?");
        $stm->execute(array($login));
        if (!$rs = $stm->fetch(PDO::FETCH_ASSOC))
            throw new InvalidArgumentException("Invalid login");
        $user = new User($rs['email'], $rs['password'], $rs['login'], $rs['id']);
        $user->setHash($rs['hash']);
        $user->setConfirm($rs['confirm']);
        return $user;
    }

    public function saveUser(User $user)
    {
        $stm = $this->connection->prepare(
                                            "INSERT INTO camagru.user (login, password, email, hash)
                                            VALUES(?, ?, ?, ?)");
        $stm->execute(array($user->getLogin(), $user->getPassword(), $user->getEmail(), $user->getHash()));
    }

    public function updateUser(User $user)
    {
        $stm = $this->connection->prepare(
                                            "UPDATE camagru.user
                                            SET login = ?, password = ?, email = ?, hash = ?, confirm = ?
                                            WHERE id = ?");
        $stm->execute(array($user->getLogin(), $user->getPassword(), $user->getEmail(),
                        $user->getHash(), $user->getConfirm(), $user->getId()));
    }
}