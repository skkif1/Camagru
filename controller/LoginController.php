<?php

require_once(root . "/model/Authorization.php");
require_once (root . "/Entity/User.php");

class LoginController
{
    public function process()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $responses = null;
        $action = new Authorization();

        if (isset($request['name']))
        {
            switch ($request['name'])
            {
                case 'SignUp':
                    $user = new User($request['email'], $request['password'], $request['login']);
                    $res = $action->signUp($user);
                    $responses = array('response' => $res);
                break ;
                case 'Change password':
                    $responses = $action->changePassword($request);
                    $responses = array("response" => $responses);
                    break ;
                case 'Reset password':
                    $responses = $action->restorePassword($request);
                    $responses = array("response" => $responses);
                    break ;
                case 'Login':
                    $responses = $action->checkLogin($request);
                    $responses = array('response' => $responses);
                    break ;
                case 'Logout':
                    $responses = $action->logout();
                    $responses = array('response' => $responses);
                    var_dump($responses);
                    break ;
                default:
                    $responses = array('response' => '404 Login');
            }
        }else
            if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes')
            {
                $res = $action->confirmEmail();
                require_once(root . "/view/html/login.php");
            }else
                require_once(root . "/view/html/login.php");

        if ($responses)
        {
            header("Content-type: application/json");
            echo json_encode($responses);
        }
    }

}