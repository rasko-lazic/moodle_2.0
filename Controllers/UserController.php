<?php

namespace FDF\Controllers;

use FDF\Models\User;

class UserController extends BaseController
{

    public function returnView()
    {

    }

    public function login()
    {
        if($this->appContainer->get('session')->check())
        {
            header('Location: http://localhost/RT5614_Rasko_Lazic/moodle_v2.0/home');
            exit;
        }

        include 'views/login.php';
    }

    public function attempt($request)
    {
        $u = new User();
        $user = $u->select('*', 'email', $request['email']);

        if(is_null($user)) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            die('Email address does not exist in our records');
        }

        if(md5($request['password']) == $user['password']) {
            $this->appContainer->get('session')->login($user);
            header('HTTP/1.1 200 success');
        } else {
            header('HTTP/1.1 403 Unauthorized');
            header('Content-Type: application/json');
            die('Incorrect password. Please check your Caps Lock key.');
        }
    }

    public function logout()
    {
        $this->appContainer->get('session')->logout();
        header('Location: http://localhost/RT5614_Rasko_Lazic/moodle_v2.0/home');
    }
}