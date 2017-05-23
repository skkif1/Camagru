<?php

require_once(root . "/DAO/UserImpl.php");
require_once(root . "/Entity/User.php");
require_once(root . "/model/EmailSender.php");

class Authorization
{
    public function signUp(User $user)
    {
        try {
            $toMySql = new UserImpl();
            $user->setHash($this->hash($user->getPassword(), 0));
            $user->setPassword($this->hash($user->getPassword(), 1));
            $toMySql->saveUser($user);
            $this->sendConfirmation($user);
        } catch (PDOException $ex) {
            if ($ex->getCode() == 23000)
                return "exist";
            else
                return "dbProblem";
        }
        return "signed";
    }

    public function confirmEmail()
    {
        if (isset($_GET['email']) && isset($_GET['hash'])) {
            $fromMysql = new UserImpl();
            $user = $fromMysql->getUserbyEmail($_GET['email']);
            if ($user->getHash() == $_GET['hash']) {
                $user->setConfirm(1);
                $user->setHash(null);
                $fromMysql->updateUser($user);
                return "confirmed";
            }
        }
        return "bad hash";
    }

    public function changePassword($request)
    {
        try {
            $mysql = new UserImpl();
            $user = $mysql->getUserbyEmail($request['email']);
            if (password_verify($request['password'] . "camagru", $user->getPassword())) {
                $user->setPassword($this->hash($request['password_new'], 1));
                $mysql->updateUser($user);
                return 'change';
            } else
                return 'wrong password';
        }catch (InvalidArgumentException $ex)
        {
            return 'noUser';
        }catch (PDOException $ex)
        {
            return 'dbProblem';
        }
    }

    public function restorePassword($request)
    {
        try
        {
            $mysql = new UserImpl();
            $user = $mysql->getUserbyEmail($request['email']);
            $mailer = new EmailSender($user->getEmail(), "Your new password on Camagru", $user->getPassword());
            if ($mailer->sendEmail()) {
                $user->setPassword($this->hash($user->getPassword(), 1));
                $mysql->updateUser($user);
                return "send";
            }
            return "mail pproblem";
        }catch (PDOException $ex)
        {
            return "dbProblem";
        }catch (InvalidArgumentException $ex)
        {
            return "noUser";
        }
    }

    public function checkLogin($request)
    {
        try {
            $mysql = new UserImpl();
            try {
                $user = $mysql->getUserbyEmail($request['login']);
            } catch (InvalidArgumentException $ex) {
                $user = $mysql->getUserbyLogin($request['login']);
            }
            if (password_verify($request['password'] . "camagru", $user->getPassword())) {
                {
                    $_SESSION['login'] = $user;
                    return "login";
                }
            } else
                return "false_password";
        } catch (InvalidArgumentException $ex) {
            return 'false';
        } catch (PDOException $ex) {
            return "dbProblem";
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        return 'true';
    }

    public function IsLogged()
    {
        if (isset($_SESSION['login']))
        {
            return $_SESSION['login']->getLogin();
        }
        return "false";
    }

    private function hash($password, $pass = 0)
    {

        if ($pass) {
            $hash = password_hash($password . 'camagru', PASSWORD_BCRYPT);

        } else
            $hash = hash("whirlpool", $password . 'CAMAGRU');
        return $hash;
    }

    private function sendConfirmation(User $user)
    {
        $message = "<html><a href='http://10.111.7.2:8080/Camagru/login?confirm=yes&email="
            . $user->getEmail() . "&hash="
            . $user->getHash()
            . "'> confirm your email on Camagru</a><br></html>";
        $sender = new EmailSender($user->getEmail(), "Confirmation Letter Camagru", $message);
        $sender->sendEmail();
    }
}

?>