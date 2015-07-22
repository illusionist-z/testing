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
         
    }
    public function usersettingAction() {
     $user= new Db\CoreMember;
     $id=$this->session->user['member_id'];
     $user= $user->UserDetail($id);
     $this->view->userdetail=$user;
    }
    
   
 
        
     
        
   
  
}
