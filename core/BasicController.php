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
abstract class BasicController
{
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
    public function __construct($request)
    {
        $this->request = $request;
        $this->init();
        $this->routes = $this->initRoutes();
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
        require_once "contrib/models/$model_path/$model_name.php";
        $modelName = ucfirst($model_path).ucfirst($model_name);
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
        $h2o = new \h2o('contrib/views/' . $name);
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