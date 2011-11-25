<?php
/*
 * Controller for main part
 */

class MainController extends \toodle\core\BasicController
{
    /**
     * Performs "global" variables initialization and, maybe, something other stuff
     */
    public function init()
    {
        $this->setVar('login','admin');
    }

    public function run__index()
    {
        $params = array('title'=>array('test'=>'Test, world!','hello'=>'Hello, world!'));
        return $this->loadView('index.html',$params);
    }
}
?>