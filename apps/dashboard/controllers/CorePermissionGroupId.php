<?php

namespace salts\Dashboard\Controllers;
use salts\Core\Models\Db;
use Phalcon\Flash\Direct as FlashDirect;
class IndexController extends  ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/boot.css');
        $this->permission = $this->setPermission();
        $this->view->module_name =  $this->router->getModuleName();
    }
 /**
     * 
     *Check User or Admin 
     */
    public function indexAction() {
   
        
        
        
       
    }
    


    
}
