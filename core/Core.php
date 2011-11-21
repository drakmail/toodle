<?php
namespace toodle\core;

/**
 * Performs framework initialization
 */
class Core
{
    /**
     * @var \array $_GET array
     */
    private $get;
    /**
     * @var array $_POST array
     */
    private $post;
    /**
     * Initialization of core class
     * @param $get array Get params array
     * @param $post array Post params array
     */
    public function __construct($get,$post)
    {
        $this->setGet($get);
        $this->setPost($post);
        echo "Initializing engine...";
    }

    /**
     * @return array module and action by given $get array
     */
    public function getRoute()
    {
        $return = array ('module'=>'','action'=>'');
        if ($this->getGet('page') == "")
        {
            $return['module'] = 'main';
        } else $return['module'] = $this->getGet('page');
        if ($this->getGet('action') == "")
        {
            $return['action'] = 'index';
        } else $return['action'] = $this->getGet('action');
        return $return;
    }

    /**
     * @param $key string key of $_GET array
     * @return string returns key of $_GET array
     */
    public function getGet($key)
    {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        } else return '';
    }

    /**
     * @param array $get
     */
    private function setGet($get)
    {
        //TODO: Add autoescape for this
        $this->get = $get;
    }

    /**
     * @param $key string key of $_POST array
     * @return string returns key of $_POST array
     */
    public function getPost($key)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        } else return '';
    }

    /**
     * @param array $post
     */
    private function setPost($post)
    {
        //TODO: Add autoescape for this
        $this->post = $post;
    }
}

?>