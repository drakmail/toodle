<?php
/*
 * Controller for main part
 */

use toodle\core\BasicController;

class MainController extends BasicController
{
    /**
     * Performs "global" variables initialization and, maybe, something other stuff
     */
    public function init()
    {
        $this->setVar('login','admin');
    }

    /**
     *  Performs routes initialization
     * @return array Array of routes for controller
     */
    protected function initRoutes()
    {
        $routes['/'] = 'run__index';
        $routes['/test/'] = 'run__index';
        $routes['/item/(?P<number>\d+)'] = 'run__item';
        return $routes;
    }

    public function run__index()
    {
        $params = array('title'=>array('test'=>'Test, world!','hello'=>'Hello, world!'));
        return $this->loadView('index.html',$params);
    }

    public function run__item($number)
    {
        $params = array('NUM'=>'number: '.$number);
        return $this->loadView('number.html',$params);
    }
}
?>