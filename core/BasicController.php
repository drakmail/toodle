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
    protected $module_name;

    public function __construct($module_name) {
        $this->module_name = $module_name;
    }

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
     * @param array $params
     * @return string Page
     */
    protected function loadView($name,$params)
    {
        require_once('h2o.php');
        $h2o = new \h2o('contrib/' . $this->module_name . '/views/' . $name);
        return $h2o->render(compact('params'));
    }
}

?>