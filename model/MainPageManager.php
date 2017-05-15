<?php

require_once (root . "/DAO/PhotoImpl.php");
require_once (root . "/DAO/MessageImpl.php");
require_once (root . "/Entity/Message.php");

class MainPageManager
{
    public function getAllImg($request)
    {
      $mysql = new PhotoImpl();
      $res = $mysql->getAllPhoto($request['offset']);
      return $res;
    }

    public function saveComment($request)
    {
      $mysql = new MessageImpl();

      if (!isset($_SESSION['login']))
            return 'logout';

      $user = $_SESSION['login'];
      $message = new Message(0, $request['text'], $user->getLogin(), $request['id']);
      $mysql->saveMessage($message);
      $res = array('user' => $user->getLogin(), 'message' => $message->getText());
      return $res;
    }

    public function getComments($request)
    {
        $mysql = new MessageImpl();
        $res = $mysql->getMessages($request['id']);
        return $res;
    }

}