<?php

namespace salts\Help\Controllers;

use Library;

class ControllerBase extends Library\Core\Controller {

    public function getModuleName() {
        $url = str_replace("\\", "/", __DIR__);
        $module = explode("/", $url);
        $this->view->module_name = $module[5];
    }

}
