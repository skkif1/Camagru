<?php

require_once (root . "/model/MainPageManager.php");
require_once (root . "/Entity/Message.php");

class MainPageController
{
    public function process()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $action = new MainPageManager();
        $response = null;

        if (isset($request['action']))
        {
            try {
                switch ($request['action']) {
                    case 'all':
                        $response = $action->getAllImg($request);
                        $response = array('response' => $response);
                        break;
                    case 'message':
                        $response = $action->saveComment($request);
                        $response = array('response' => $response);
                        break;
                    case 'showComments':
                        $response = $action->getComments($request);
                        $response = array('response' => $response);
                        break;
                    case 'rate':
                        $response = $action->ratePost($request);
                        $response = array('response' => $response);
                        break;
                    case 'getRate':
                        $response = $action->getRate($request);
                        $response = array('response' => $response);
                        break;
                }
            }catch (Exception $ex)
            {
                require_once (root . "/view/html/problem.php");
                die();
            }
        }else
        {
            require_once(root . "/view/html/mainPage.php");
        }
        if ($response)
        {
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
}