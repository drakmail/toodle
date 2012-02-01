<?php

use core\BasicModel;
use core\ORM;

/**
 * Users model
 */
class SystemUsers extends BasicModel
{
    public function getUsersList()
    {
        try {
            $users = ORM::find('users');
            return $users;
        } catch (Exception $e) {
            return array();
        }
    }
}

?>