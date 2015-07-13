<?php

namespace workManagiment\Dashboard\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');
        
      
        
    }
   
    public function checkinAction(){
       $id= $this->session->user['member_id'];
        $note=$this->request->get('note');  
        $lat=  $this->request->get('lat');
        $lon=  $this->request->get('lng');
        
//        echo "<script type='text/javascript'>window.location.href='attendances';</script>";
//        $this->view->disable();
       $checkin=new \workManagiment\Dashboard\Models\Attendances();
       $checkin->setcheckintime($id,$note,$lat,$lon);
      
    }
    
    public function checkoutAction(){
        $id= $this->session->user['member_id'];
       $checkout=new \workManagiment\Dashboard\Models\Attendances();
       $checkout->setcheckouttime($id);
    }
}

