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
require_once '../../core/Security.php';

/**
 * Test security module
 */
class SecurityTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test user input escaping
     * @dataProvider provideStringParams
     * @param string $string
     */
    public function testStringEscaping($result,$string)
    {
        $this->assertEquals($result,\toodle\core\Security::safeStr($string));
    }

    /**
     * Test converting float to unified format
     * @dataProvider provideFloatParams
     * @param string $exp
     * @param string $float
     */
    public function testFloatFormat($exp,$float) {
        $this->assertEquals($exp,\toodle\core\Security::safeFloat($float));
    }

    /**
     * Provide params for string test
     * @return array
     */
    public function provideStringParams()
    {
        return array (
            array('',''),
            array('test','test'),
            array('проверка','проверка'),
            array('test_проверка','test_проверка'),
            array('a\b\c\d','a\b\c\d'),
            array('&lt;b&gt;Some Html Tags&lt;/b&gt;','<b>Some Html Tags</b>'),
            array('&lt;a href=&quot;#&quot;&gt;&lt;img src=&quot;test.png&quot; alt=&quot;more HTML tags&quot; title=&quot;O_O&quot;&gt;&lt;/a&gt;','<a href="#"><img src="test.png" alt="more HTML tags" title="O_O"></a>')
        );
    }

    /**
     * Provide params for float test
     * @return array
     */
    public function provideFloatParams()
    {
        return array (
            array ('0.0','0'),
            array ('1.0','1.0'),
            array ('0.1','0.1'),
            array ('1.0','1')
        );
    }
}

?>