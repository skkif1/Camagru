<?php

require_once (root . "/DAO/PhotoImpl.php");

class MainPageManager
{
    public function getAllImg()
    {
      $mysql = new PhotoImpl();
      $res = $mysql = $mysql->getPublicPhoto();
      return $res;
    }
}