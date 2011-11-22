<?php
/*
 * Controller for main part
 */

class MainController extends \toodle\core\BasicController
{
    public function run__index()
    {
        $params = array('title'=>array('test'=>'Test, world!','hello'=>'Hello, world!'));
        return $this->loadView('index.html',$params);
    }
}
?>