<?php

use core\BasicController;
use core\ORM;

class AdminUsersController extends BasicController
{
    public function init()
    {
        $this->auth = $this->loadModel('system/auth');
        $this->setVar('user',$this->auth->getUser());
        $this->setVar('path','/contrib/resources/admin');
        $this->logged = $this->auth->checkCookie();
    }

    /**
     *  Performs routes initialization
     * @return array Array of routes for controller
     */
    public function initRoutes()
    {
        $routes = array();
        if ($this->logged) {
          $routes['^/admin/users/$'] = 'users_list';
          $routes['^/admin/users/add/$'] = 'users_add';
          $routes['^/admin/users/add/commit/$'] = 'users_add_commit';
          $routes['^/admin/users/group-remove/$'] = 'users_group_remove';
        }
        return $routes;
    }
    
    /**
     * Список пользователей
     */
    public function users_list()
    {
        $usersModel = $this->loadModel('system/users');
        $usersList = $usersModel->getUsersList();
        $params = array('users'=>$usersList);
        return $this->loadView('admin/users/list.html',$params);
    }
    
    /**
     * Добавление пользователя
     */
    public function users_add()
    {
        $params = array();
        return $this->loadView('admin/users/add.html',$params);
    }
    
    /**
     * Добавление пользователя (завершение)
     */
    public function users_add_commit()
    {
        $result = false;
        if ($_POST['password1'] == $_POST['password2']) {
            $result = $this->auth->addUser($_POST['login'],$_POST['name'],$_POST['password1'],$_POST['email']);
        }
        if ($result) {
            $params = array('message'=>'Пользователь успешно добавлен!');
            return $this->loadView('admin/result/success.html',$params);
        } else {
            $params = array('message'=>'Ошибка добавления пользователя!');
            return $this->loadView('admin/result/fail.html',$params);
        }
    }
    
    public function users_group_remove()
    {
        foreach ($_POST['group_users'] as $user) {
            $this->auth->removeUser($user);
        }
        header('Location: /admin/users/');
    }
}
?> 
