<?php

require_once (root . "/controller/MainPageController.php");
require_once (root . "/controller/LoginController.php");
require_once (root . "/controller/PhotoMakerController.php");

class Router
{
    private $url;
    private $controller;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function run()
    {
        session_start();
       if (preg_match("!^/camagru/!", strtolower($this->url)))
           $this->controller = new MainPageController();
       if (preg_match("!^/camagru/login!", strtolower($this->url)))
        $this->controller = new LoginController();
       if (preg_match("!^/camagru/user!", strtolower($this->url)))
           $this->controller = new PhotoMakerController();
       if ($this->controller != NULL)
           $this->controller->process();
       else
           require_once (root . "/view/html/404.php");
    }

}