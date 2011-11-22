<?php
/**
 * TOODLE
 *
 * PHP Version 5.3
 *
 * @category  Framework
 * @package   Core
 * @author    Alexander Maslov <it@delta-z.ru>
 * @copyright 2011 Alexader Maslov (http://www.delta-z.ru)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3
 * @link      https://github.com/drakmail/toodle
 */

namespace toodle\core;

/**
 *
 */
abstract class BasicController
{

    /**
     * Main method of controller.
     * @abstract
     *
     */
    abstract public function run();

    /**
     * Load model by name
     * @static
     * @param string $name
     * @return Model
     */
    protected function loadModel($name)
    {

    }

    /**
     * Load view by name
     * @param string $name
     * @return View
     */
    protected function loadView($name)
    {

    }
}

?>