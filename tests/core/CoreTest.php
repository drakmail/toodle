<?php

/**
 * TOODLE
 *
 * PHP Version 5.3
 *
 * @category  Framework
 * @package   Test
 * @author    Alexander Maslov <it@delta-z.ru>
 * @copyright 2011 Alexader Maslov (http://www.delta-z.ru)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3
 * @link      https://github.com/drakmail/toodle
 */

require_once 'PHPUnit/Autoload.php';
require_once '../../core/Core.php';

/**
 * Test class for Core
 */
class CoreTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup fixture
     */
    protected function setUp()
    {
    }

    /**
     * Shutdown fixture
     */
    protected function tearDown()
    {
    }

    /**
     * @dataProvider provideParams
     * Must return array (module,action)
     * @param $get array get array
     * @param $post array post array
     */
    public function testRoute($get,$post)
    {
        $core = new \toodle\core\Core($get,$post);
        if (!isset($get['page'])) $get['page'] = null;
        if (!isset($get['action'])) $get['action'] = null;
        $this->assertEquals(array('module'=>$get['page'] == '' ? 'main' : $get['page'],
            'action'=>$get['action'] == '' ? 'index' : $get['action']),$core->getRoute());
    }

    /**
     * Function, that providing get and post parameters for testRoute function.
     * Provides no params, only one param, and many other combinations.
     * @return array 2 arrays of $get and $post arrays
     */
    public function provideParams()
    {
        return array (
            array ( array(), array() ),
            array ( array('action'=>''), array() ),
            array ( array('page'=>''), array() ),
            array ( array('page'=>'','action'=>''), array() ),
            array ( array('page'=>'main','action'=>'index'), array() ),
            array ( array('page'=>'main','action'=>''), array() ),
            array ( array('page'=>'','action'=>'index'), array() ),
            array ( array('page'=>'pageName','action'=>'actionName'), array() ),
            array ( array('page'=>'pageName','action'=>''), array() ),
            array ( array('page'=>'','action'=>'actionName'), array() ),
        );
    }
}

?>