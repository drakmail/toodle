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
      'system/auth', //Авторизация
      'admin/admin', //Администрирование
      '/main'  //Основной сайт
    );
    $this->loadModules($modules);
  }
}
?>