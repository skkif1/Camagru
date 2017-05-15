<?php

require_once(root . "/DAO/PhotoImpl.php");
require_once (root . "/Entity/Photo.php");
require_once (root . "/Entity/User.php"); //for debug include ... delete

class PhotoHandler
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = new PhotoImpl();
    }

    public function savePhoto($request)
    {
        $user = $_SESSION['login'];
        if (isset($request['img']))
        {
            $photo = new Photo(0, $request['img'], $user->getId());
            return $this->mysql->savePhoto($photo);
        }
        return 'error';
    }

    public function getUsersPhoto()
    {
        $user = $_SESSION['login'];
        $data = $this->mysql->getUsersPhoto($user);
        return $data;
    }

    public function removePhoto($request)
    {
        $user = $_SESSION['login'];
        $id = $request['id'];
        $data = $this->mysql->removePhoto($id, $user);
        return $data;
    }

    public function checkLogin()
    {
        if (isset($_SESSION['login']))
            return 1;
        return 0;
    }
}