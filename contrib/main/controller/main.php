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
//        $test = ORM::dispense('test');
//        $test->name = 'toodle';
//        ORM::store($test);
    }

    public function run__index()
    {
        $params = array('title'=>array('test'=>'Test, world!','hello'=>'Hello, world!'));
        return $this->loadView('index.html',$params);
    }
}
?>