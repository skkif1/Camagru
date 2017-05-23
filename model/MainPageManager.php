<?php

require_once (root . "/DAO/PhotoImpl.php");
require_once (root . "/DAO/MessageImpl.php");
require_once (root . "/DAO/UserImpl.php");
require_once (root . "/Entity/Message.php");
require_once (root . "/DAO/RateImpl.php");

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
      $mysqlUser = new UserImpl();

      if (!isset($_SESSION['login']))
            return 'logout';

      $user = $_SESSION['login'];
      $message = new Message(0, $request['text'], $user->getLogin(), $request['id']);
      $mysql->saveMessage($message);
      $res = array('user' => $user->getLogin(), 'message' => $message->getText());
      $user = $mysqlUser->getUserbyPhoto($request['id']);
      $this->sendNotyfication($user);
      return $res;
    }

    public function getComments($request)
    {
        $mysql = new MessageImpl();
        $res = $mysql->getMessages($request['id']);
        return $res;
    }

    public function ratePost($request)
    {
        if (isset($_SESSION['login']))
        {
            $mysqlRate = new RateImpl();
            $mysql = new PhotoImpl();
            $ifExist = $mysqlRate->checkRate($request['id'], $_SESSION['login']->getId());
            if(!$ifExist)
            {
                $mysqlRate->updateRate($request['id'], $_SESSION['login']->getId());
                $mysql->RatePhoto($request['id']);
            }else
            {
                $mysqlRate->deleteRate($request['id'], $_SESSION['login']->getId());
                $mysql->RatePhotoDec($request['id']);
            }
            $count = $mysql->getRatePhoto($request['id']);
            return $count;
        }
        return 'logout';
    }

    public function getRate($request)
    {
        $mysql = new PhotoImpl();
        $res = $mysql->getRatePhoto($request['post']);
        return $res;
    }

    private function sendNotyfication(User $user)
    {
        $message = "<html><a href='http://10.111.7.2:8080/Camagru/>'>someone comment your photo on Camagru</a><br>";
        $sender = new EmailSender($user->getEmail(), "You have new comment", $message);
        $sender->sendEmail();
    }
}