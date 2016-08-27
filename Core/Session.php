<?php

namespace FDF\Core;

use FDF\Models\User;

class Session
{
    /**
     * Method that checks if we have logged in user;
     *
     * @return bool
     */
    public function check()
    {
        if(array_key_exists('loggedIn', $_SESSION)) {
            if($_SESSION['loggedIn']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Login method
     *
     * @param $user
     */
    public function login($user)
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $user['id'];
    }

    /**
     * Logout method
     *
     */
    public function logout()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Fetches logged in user model
     *
     * @return array|null
     */
    public function user()
    {
        $u = new User();

        if($this->check()) {
            return $u->select('*', 'id', $_SESSION['userId']);
        } else {
            return null;
        }
    }
}