<?php

use toodle\core\BasicModel;
use toodle\core\ORM;

/**
 * User authentication
 */
class Auth extends \toodle\core\BasicModel
{
    /**
     * Create user for auth stuff
     * @param $login string login
     * @param $username string username
     * @param $password string password
     */
    public function addUser($login,$username,$password)
    {
        $userBean = ORM::dispense('users');
        $userBean->login = $login;
        $userBean->name = $username;
        $userBean->password = md5($password);
        ORM::store($userBean);
    }

    /**
     * Function check's does user exists
     * @param $login string Login of user
     * @param $password string Password of user
     * @return array $user
     */
    public function checkAuth($login,$password)
    {
        $user = ORM::find('users','login = :login AND password = :password', array(':login'=>$login, ':password'=>md5($password)) );
        $user = $user[1];
        return $user;
    }

    /**
     * Set user auth cookie
     * @param $user
     */
    public function setCookie($user)
    {
        setcookie('t-auth',$user->getID().":".md5(md5($user->password)),time()+100000,'/');
    }

    public function clearCookie()
    {
        setcookie('t-auth','',time() - 3600,'/');
    }

    /**
     * Check does cookie exists and does it true
     * @return bool
     */
    public function checkCookie()
    {
        $cookie = $_COOKIE['t-auth'];
        $cookie = explode(':',$cookie);
        $user_id = $cookie[0];
        $password = $cookie[1];
        $user = ORM::find('users','id = :id', array(':id'=>$user_id) );
        if ($user != null)
        {
            if (md5(md5($user[1]->password)) == $password)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Return current user or null if anonymous
     * @return mixed
     */
    public function getUser()
    {
        $cookie = $_COOKIE['t-auth'];
        $cookie = explode(':',$cookie);
        $user_id = $cookie[0];
        $password = $cookie[1];
        $user = ORM::find('users','id = :id', array(':id'=>$user_id) );
        if ($user != null)
        {
            if (md5(md5($user[1]->password)) == $password)
            {
                return $user[1];
            }
        }
        return null;
    }
}

?>