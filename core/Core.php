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
require_once "Security.php";

/**
 * Performs framework initialization
 */
class Core
{
    /**
     * Array of escaped $_GET elements
     * @var array $_GET array
     */
    private $get;

    /**
     * * Array of escaped $_POST elements
     * @var array $_POST array
     */
    private $post;

    /**
     * Request array (get and post variables)
     * @var
     */
    private $request;

    /**
     * Initialization of core class
     * @param $get array Get params array
     * @param $post array Post params array
     */
    public function __construct($get,$post)
    {
        $this->setGet($get);
        $this->setPost($post);
        $this->initRequest();
        $route = $this->getRoute();
        /* Load selected module controller */
        $module = $route['module'];
        require_once "contrib/$module/controller/$module.php";
        $moduleControllerName = ucfirst($module).'Controller';
        $controller = new $moduleControllerName($module,$this->getRequestArray());
        $routes = $controller->searchRoute($_SERVER['REQUEST_URI']);
        $method = $routes['method'];
        $params = $routes['params'];
        $page = $controller->__named($method,$params);
        echo $page;
    }

    /**
     * Returns class and method to call for given $get array
     * @return array module and action by given $get array
     */
    public function getRoute()
    {
        $return = array ('module'=>'','action'=>'');
        if ($this->getGet('page') == "")
        {
            $return['module'] = 'main';
        } else $return['module'] = $this->getGet('page');
        //TODO: fix modules work
        return $return;
    }

    /**
     * Returns value of given key of $get array
     * @param string key of $get array
     * @return string returns the key of $get array, or empty string if key doesn't exists
     */
    public function getGet($key)
    {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        } else return '';
    }

    /**
     * Autoescape given array and set it as the internal $get array
     * @param array $get
     */
    private function setGet($get)
    {
        foreach ($get as $key => $value)
        {
            $this->get[$key] = Security::safeStr($value);
        }
    }

    /**
     * Returns value of given key of $post array
     * @param string key of $post array
     * @return string returns key of $post array, or empty string if key doesn't exists
     */
    public function getPost($key)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        } else return '';
    }

    /**
     * Autoescape given array and set it as the internal $post array
     * @param array $post
     */
    private function setPost($post)
    {
        foreach ($post as $key => $value)
        {
            $this->post[$key] = Security::safeStr($value);
        }
    }

    /**
     * Initialize request array
     */
    private function initRequest()
    {
        if ($this->get == NULL) $this->get=array();
        if ($this->post == NULL) $this->post=array();
        $this->request = array_merge($this->get,$this->post);
    }

    /**
     * Return request array
     * @return mixed
     */
    public function getRequestArray()
    {
        return $this->request;
    }
}

?>