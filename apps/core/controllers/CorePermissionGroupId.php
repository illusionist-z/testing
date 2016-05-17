<?php

namespace salts\Core\Controllers;

use Phalcon\Flash\Direct as FlashDirect;

class CorePermissionFroupIdAction extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->permission = $this->setPermission();
        $this->view->module_name = $this->router->getModuleName();
    }

    /**
     * 
     * Check User or Admin 
     */
    public function CorePermissionFroupIdAction() {
        
    }

}
