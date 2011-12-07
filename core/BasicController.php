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
     * @var Name of module
     */
    protected $module_name;
    /**
     * @var "Global" module params
     */
    protected $view_params;

    /**
     * @var request array
     */
    private $request;

    /**
     * @var array of the routes
     */
    private $routes;

    /**
     * @param $module_name Name of module
     * @param $request Request array
     */
    public function __construct($module_name,$request)
    {
        $this->module_name = $module_name;
        $this->request = $request;
        $this->setVar('name',$module_name);
        $this->setupORM();
        $this->init();
        $this->routes = $this->initRoutes();
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
     * @abstract
     *  Performs routes initialization
     */
    abstract protected function initRoutes();

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
     * Set view variable name and value
     * @param string $name
     * @param string $value
     */
    protected function setVar($name,$value)
    {
        $this->view_params[$name] = $value;
    }

    /**
     * Load model by name (must begin with slash (ex. "/model" or "type/model")
     * @static
     * @param string $name
     * @return Model
     */
    protected function loadModel($name)
    {
        $model = explode('/',$name);
        $model_path = $model[0];
        $model_name = $model[1];
        require_once "contrib/".$this->module_name."/models/$model_path/$model_name.php";
        $modelName = ucfirst($model_name);
        return new $modelName($this->request);
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
        $module = $this->view_params;
        return $h2o->render(compact('params','module'));
    }

    /**
     * Pass method arguments by name
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __named($method, array $args = array())
    {
        $reflection = new \ReflectionMethod($this, $method);

        $pass = array();
        foreach($reflection->getParameters() as $param)
        {
            /* @var $param ReflectionParameter */
            if(isset($args[$param->getName()]))
            {
                $pass[] = $args[$param->getName()];
            }
            else
            {
                $pass[] = $param->getDefaultValue();
            }
        }

        return $reflection->invokeArgs($this, $pass);
    }
}

?>