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

namespace {
  use core\Core;
  
  set_include_path(get_include_path() . PATH_SEPARATOR . './core/h2o');
  function __autoload($className) {
      @include(__DIR__ . "/" . str_replace('\\','/',$className) . ".php");
  }

  /**
  * Bootstrap class
  */
  class Index
  {
      /**
      * @var core\Core
      */
      private $core;

      /**
      * Init core framework parts
      */
      public function __construct()
      {
          $this->core = new Core($_GET,$_POST,$_SERVER['REQUEST_URI']);
      }
  }

  new Index();

}
?>