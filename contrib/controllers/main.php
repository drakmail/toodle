<?php
/*
 * Контроллер модуля main. Содержит в себе:
   Список URL
   Обработчики
   Код инициализации
 */

use core\BasicController;
use core\ORM;

class MainController extends BasicController
{
    /**
     * Performs "global" variables initialization and, maybe, something other stuff
     */
    public function init()
    {
        $this->auth = $this->loadModel('system/auth');
        $this->setVar('user',$this->auth->getUser());
    }

    /**
     *  Performs routes initialization
     * @return array Array of routes for controller
     */
    public function initRoutes()
    {
        $routes['^/'] = 'not_found';
        $routes['^/$'] = 'index';
        $routes['^/init/$'] = 'createAdmin';
        $routes['^/number/(?P<number>\d+)/$'] = 'number';
        return $routes;
    }

    public function index()
    {
        $params = array();
        return $this->loadView('index.html',$params);
    }
    
    public function createAdmin()
    {
        $result = $this->auth->addUser('admin','Administrator','12345','admin@localhost');
        $params = array('result'=>$result);
        return $this->loadView('create.html',$params);
    }

    public function number($number)
    {
        $params = array('number'=>$number);
        return $this->loadView('number.html',$params);
    }
    
    public function not_found
    ()
    {
        $params = array();
        return $this->loadView('404.html',$params);
    }
}
?>