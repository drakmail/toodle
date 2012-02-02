<?php
/**
 "Проект": сущность, которая загружает необходимые модули и управляет ими. 
*/

namespace contrib;

use core\AbstractSite;

class MainSite extends AbstractSite
{
  public function init()
  {
    $modules = array(
      '/main',  //Основной сайт
      'system/auth', //Авторизация
      'admin/admin', //Администрирование (общее)
      'admin/adminUsers' //Администрирование (пользователи и группы)
    );
    $this->loadModules($modules);
  }
}
?>