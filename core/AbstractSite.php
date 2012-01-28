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

namespace core;

/**
 *
 */
abstract class AbstractSite
{
    /**
     * @var request array
     */
    private $request = null;
    
    private $buffer = null;
    
    private $routes = array();

    /**
     * @param $request Request array
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->setupORM();
        $this->buffer = null;
        $this->init();
    }

    /**
     * Initialize ORM
     */
    private function setupORM()
    {
        require "RedBeanORM.php";
        ORM::setup("sqlite:db/toodle.db");
    }

    /**
     * @abstract
     * Performs after-creation initialization
     */
    abstract public function init();
    
    /**
    * Возвращает список путей
    */
    public function getRoutes()
    {
      return $this->routes;
    }
    
    /**
    * Регистрирует новые пути в системе
    */
    private function addRoutes($module,$routes)
    {
      /* Конвертация роутов таким образом, чтобы было ясно, к какому модулю какой путь относится*/
      $converted_routes = array();
      foreach ($routes as $url=>$function) {
        $converted_routes[$url] = array("module"=>$module,"function"=>$function);
      }
      $this->routes = array_merge($this->getRoutes(),$converted_routes);
    }
    
    /**
     * @param string $path URL
     * @return array array of method and params (array('method'=>$method, 'params'=>$matches))
     */
    public function searchRoute($path) {
        $result = array ('method'=>'not_found','params'=>array('path'=>$path));
        foreach ($this->routes as $route => $method) {
            $route = str_replace('/','\/',$route);
            $route = '/'.$route.'/';
            if (preg_match($route,$path,$matches)) {
                $result = array('method'=>$method, 'params'=>$matches);
            }
        }
        return $result;
    }
    
    /**
    * Загружает модули из списка
    */
    public function loadModules($modules)
    {
      foreach ($modules as $module) {
        $this->loadModule($module);
      }
    }
    
    /**
    * Выполняет загрузку модуля $module
    */
    public function loadModule($module)
    {
      $controller = explode('/',$module);
      $controller_path = $controller[0];
      $controller_name = $controller[1];
      require_once "contrib/controllers/$controller_path/$controller_name.php";
      $moduleController = ucfirst($controller_name)."Controller";
      $this->modules[$module] = new $moduleController($this->request);
      $this->modules[$module]->init();
      $this->addRoutes($module,$this->modules[$module]->initRoutes());
    }
}

?>