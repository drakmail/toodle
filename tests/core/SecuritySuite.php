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

require_once "SecurityTest.php";

/**
 * Test Suite for testing Security class
 */
class SecuritySuite extends PHPUnit_Framework_TestSuite
{
    /**
     * @static
     * @return \SecuritySuite
     */
    public static function suite()
    {
        $suite = new SecuritySuite('SecurityTests');
        $suite->addTestSuite('SecurityTest');
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