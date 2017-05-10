<?php

require_once (root . "/controller/MainPageController.php");
require_once (root . "/controller/LoginController.php");

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
       if (preg_match("!^/Camagru/!", $this->url))
        $this->controller = new MainPageController();
       if (preg_match("!^/Camagru/login!", $this->url))
        $this->controller = new LoginController();
       if ($this->controller != NULL)
           $this->controller->process();
       else
           echo "404 not found";
    }

}