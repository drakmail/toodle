<?php

use core\BasicModel;
use core\ORM;

/**
 * User authentication
 */
class SystemAuth extends BasicModel
{
    /**
     * Create user for auth stuff
     * @param string $login login
     * @param string $username username
     * @param string $password password
     */
    public function addUser($login,$username,$password,$email)
    {
      try {
        // Check does user already exists...
        if (ORM::findOne('users',' login = ? OR name = ? OR email = ? ',array($login,$username,$email)) != NULL) { return false; }
      } catch (Exception $e) {
      }
      
      try {
        $userBean = ORM::dispense('users');
        $userBean->login = $login;
        $userBean->name = $username;
        $userBean->password = md5($password);
        $userBean->email = $email;
        ORM::store($userBean);
        return true;
      } catch (Exception $e) {
        return false;
      }
    }
    
    /**
     * Remove user by id
     * @param int $id
     */
    public function removeUser($id)
    {
      ORM::begin();
      try {
        $user = ORM::load('users',$id);
        ORM::trash($user);
        ORM::commit();
        return true;
      } catch (Exception $e) {
        ORM::rollback();
        return false;
      }
      
    }

    /**
     * Function check's does user exists
     * @param $login string Login of user
     * @param $password string Password of user
     * @return array $user
     */
    public function checkAuth($login,$password)
    {
        $user = ORM::findOne('users','login = :login AND password = :password', array(':login'=>$login, ':password'=>md5($password)) );
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
        if (!isset($_COOKIE['t-auth'])) return false;
        $cookie = $_COOKIE['t-auth'];
        $cookie = explode(':',$cookie);
        $user_id = $cookie[0];
        $password = $cookie[1];
        $user = ORM::findOne('users','id = :id', array(':id'=>$user_id) );
        if ($user != null)
        {
            if (md5(md5($user->password)) == $password)
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
        if (!isset($_COOKIE['t-auth'])) return null;
        $cookie = $_COOKIE['t-auth'];
        $cookie = explode(':',$cookie);
        $user_id = $cookie[0];
        $password = $cookie[1];
        $user = ORM::findOne('users','id = :id', array(':id'=>$user_id) );
        if ($user != null)
        {
            if (md5(md5($user->password)) == $password)
            {
                return $user;
            }
        }
        return null;
    }
}

?>