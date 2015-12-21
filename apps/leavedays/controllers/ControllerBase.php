<?php namespace salts\Leavedays\Controllers;

// use library
use Library;

class ControllerBase extends Library\Core\Controller 
{
      public function getmodulename() {
                  $url = str_replace("\\","/",__DIR__);                                 
                  $module= explode("/",$url);
                  $this->view->module_name = $module[5];
    }
}
