<?php

namespace workManagiment\Leavedays\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');        
        $user = $this->session->get('user');        
        $this->response->redirect('applyleave');        
    }
    
  
}

