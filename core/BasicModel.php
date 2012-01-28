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

use core\ORM;

/**
 * Basic model class
 */
class BasicModel
{
    /**
     * @var array request
     */
    private $request;

    /**
     * Constructor
     * @param $request array request array
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * return request array
     * @return array
     */
    public function getRequestArray()
    {
        return $this->request;
    }

    /**
     * @param $key string request key
     */
    public function request($key)
    {
        return $this->request[$key];
    }
}
