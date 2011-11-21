<?php
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