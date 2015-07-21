<?php


namespace workManagiment\Setting\Controllers;
use workManagiment\Core\Models\Db;
class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');        
        
        //$this->response->redirect('applyleave');        
    }
    public function usersettingAction() {
     
    }
    
   
 
        
     
        
   
  
}
