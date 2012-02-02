<?php

use core\BasicController;
use core\ORM;

class AdminController extends BasicController
{
    public function init()
    {
        $this->auth = $this->loadModel('system/auth');
        $this->setVar('user',$this->auth->getUser());
        $this->setVar('path','/contrib/resources/admin');
        $this->logged = $this->auth->checkCookie();
    }

    /**
     *  Performs routes initialization
     * @return array Array of routes for controller
     */
    public function initRoutes()
    {
        $routes['^/admin/'] = 'not_found';
        if ($this->logged) {
          $routes['^/admin/$'] = 'index';
        } else {
          $routes['^/admin/$'] = 'login';
          $routes['^/admin/login/check/$'] = 'login_check';
        }
        return $routes;
    }
    
    public function index()
    {
        $params = array();
        return $this->loadView('admin/main.html',$params);
    }
    
    public function login()
    {
        $params = array();
        return $this->loadView('admin/login.html',$params);
    }
    
    public function login_check()
    {
        $user = $this->auth->checkAuth($_POST['login'],$_POST['password']);
        if ($user != null) {
            $this->auth->setCookie($user);
            header('Location: /admin/');
        } else {
            $params = array('error'=>'Неверный логин или пароль');
            return $this->loadView('admin/login.html',$params);
        }
    }
    
    public function not_found()
    {
        header("HTTP/1.0 404 Not Found");
        $params = array();
        return $this->loadView('admin/404.html',$params);
    }
}
?> 
