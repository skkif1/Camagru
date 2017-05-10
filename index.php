<?php
    define("root", __DIR__);

    require_once (root . "/controller/Router.php");

    ini_set("display_errors", 1);

    $router = new Router($_SERVER['REQUEST_URI']);

    $router->run();



?>