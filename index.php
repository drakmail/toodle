<?php
namespace toodle;

function autoload($class)
{
    $class = str_replace('toodle\\', '', $class);
    $class = str_replace('\\', '/', $class) . '.php';
    require_once($class);
}

spl_autoload_register('\toodle\autoload');

use \toodle\core\Core;

$t = new Core();
?>