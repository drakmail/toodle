<?php
/**
 * TOODLE
 *
 * PHP Version 5.3
 *
 * @category  Site
 * @package   Bootstrap
 * @author    Alexander Maslov <it@delta-z.ru>
 * @copyright 2011 Alexader Maslov (http://www.delta-z.ru)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3
 * @link      https://github.com/drakmail/toodle
 */

// TODO: Write unit test when it could be done...

namespace toodle;

set_include_path(get_include_path() . PATH_SEPARATOR . './h2o');

/**
 * Auto classloader
 * @param $class class name
 */
function autoload($class)
{
    // TODO: Khm... fix this :)
    if ($class == "H2o_Parser") return;
    if ($class == "H2o_Lexer") return;
    if (strpos($class,'Model_') === 0) return;
    $class = str_replace('toodle\\', '', $class);
    $class = str_replace('\\', '/', $class) . '.php';
    require_once($class);
}

spl_autoload_register('\toodle\autoload');

use \toodle\core\Core;

class Index
{
    /**
     * @var \toodle\core\Core
     */
    private $core;

    /**
     * Init core framework parts
     */
    public function __construct()
    {
        $this->core = new Core($_GET,$_POST);
    }
}

new Index();
?>