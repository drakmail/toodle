<?php

use core\BasicController;
use core\ORM;

class AuthController extends BasicController
{
    /**
     * Performs "global" variables initialization and, maybe, something other stuff
     */
    public function init()
    {
        $this->auth = $this->loadModel('system/auth');
        $this->logged = $this->auth->checkCookie();
        $this->setVar('user',$this->auth->getUser());
    }

    /**
     *  Performs routes initialization
     * @return array Array of routes for controller
     */
    public function initRoutes()
    {
        $routes['^/login/check/$'] = 'login_check';
        if ($this->logged) {
          $routes['^/logout/$'] = 'logout';
        } else {
          $routes['^/login/$'] = 'login';
        }
        return $routes;
    }
    
    public function login()
    {
        $params = array();
        return $this->loadView('system/login.html',$params);
    }

    public function login_check()
    {
        $user = $this->auth->checkAuth($_POST['login'],$_POST['password']);
        if ($user != null) {
            $this->auth->setCookie($user);
            header('Location: /');
        } else {
            $params = array('error'=>'Неверный логин или пароль');
            return $this->loadView('system/login.html',$params);
        }
    }

    public function logout()
    {
        $this->auth->clearCookie();
        $params = array();
        return $this->loadView('system/login.html',$params);
    }
}
?> 
