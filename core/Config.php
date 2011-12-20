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
 * Configuration class. Used for config file reading and writing.
 */
class Config
{
    /**
     * @var Config file
     */
    private $file;
    /**
     * @var Content of config file
     */
    private $content;
    /**
     * Init config file.
     * @param string $file Config filename
     */
    public function __construct($file = 'core.yml')
    {
        $this->file = $file;
    }

    /**
     * Return config file value for $key
     * @param string $key
     * @return mixed Value of $key
     */
    public function get($key)
    {
        $this->load();
        return $this->content[$key];
    }

    private function load()
    {
        if (!isset($this->content))
        {
            $this->content = sfYaml::load('config/'.$this->file);
        }
    }
}