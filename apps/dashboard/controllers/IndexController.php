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
      
    }
    
    public function checkoutAction(){
        echo "checkout";exit;
    }
}

