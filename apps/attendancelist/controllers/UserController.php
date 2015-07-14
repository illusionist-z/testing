<?php

namespace workManagiment\Attendancelist\Controllers;

class UserController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');
        
        $user = $this->session->get('user');
        
        $this->view->user = $user;
        
    }
    
    public function attendancelistAction(){
        $offset= $this->session->location['offset'];
        
        $id= $this->session->user['member_id'];
          
      $attlist = new \workManagiment\Attendancelist\Models\Attendances();
        $result_attlist = $attlist->getattlist($id,$month);
         $this->view->attlist = $result_attlist;
         $this->view->offset=$offset;
       
    }
    
   

}

