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
 * Base module class. Contains links to controller, model and view. Provides interface to interaction between
 * Controller, Model and View and compounds it together.
 */
class Module
{

    /**
     * Load controller by action
     * @param string $action
     * @return Controller
     */
    protected static function loadController($action)
    {

    }
}

?>