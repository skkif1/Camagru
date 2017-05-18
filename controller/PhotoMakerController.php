<?php
require_once(root . "/model/PhotoHandler.php");
require_once (root . "/Entity/Photo.php");

class PhotoMakerController
{

    function process()
    {

        $request = json_decode(file_get_contents('php://input'), true);
        $responses = null;
        $action = new PhotoHandler();

        if(isset($request['action']))
        {
            switch ($request['action'])
            {
                case 'check';
                    $responses = $action->checkLogin();
                    $responses = array('response' => $responses);
                    break ;
                case 'save':
                    $responses = $action->savePhoto($request);
                    $responses = array('response' => $responses);
                    break ;
                case 'getFotos':
                    $responses = $action->getUsersPhoto($request);
                    $responses = array('response' => $responses);
                    break ;
                case 'remove':
                    $responses = $action->removePhoto($request);
                    $responses = array('response' => $responses);
                    break ;
                default:
                  $responses = array('response', '404');
            }
        }else
        {
            if ($action->checkLogin())
            {
                require_once(root . "/view/html/user.php");
                return ;
            }
            require_once (root . '/view/html/error.php');
        }
        if ($responses)
        {
            header("Content-type: application/json");
            echo json_encode($responses);
        }
    }
}


