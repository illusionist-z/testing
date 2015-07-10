<?php

namespace workManagiment\Attendance\Controllers;

class AttendanceController extends ControllerBase
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
    
    public function todaylistAction(){
       echo "Today list1";exit;
        
    }

}

