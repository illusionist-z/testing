<?php

namespace workManagiment\Dashboard\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');
        
      
        
    }
   
    public function checkinAction(){
       $id= $this->session->user['member_id'];
       $checkin=new \workManagiment\Dashboard\Models\Attendances();
       $checkin->setcheckintime($id);
      
    }
    
    public function checkoutAction(){
        $id= $this->session->user['member_id'];
       $checkout=new \workManagiment\Dashboard\Models\Attendances();
       $checkout->setcheckouttime($id);
    }
}

