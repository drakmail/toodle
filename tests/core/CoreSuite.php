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

require_once "CoreTest.php";

/**
 * Test Suite for testing Core class
 */
class CoreSuite extends PHPUnit_Framework_TestSuite
{
    /**
     * @static
     * @return \CoreSuite
     */
    public static function suite()
    {
        $suite = new CoreSuite('CoreTests');
        $suite->addTestSuite('CoreTest');
        return $suite;
    }

    /**
     * For future - setup fixtures
     */
    protected function setUp()
    {
    }

    /**
     * For future - setup fixtures
     */
    protected function tearDown()
    {
    }
}
?>