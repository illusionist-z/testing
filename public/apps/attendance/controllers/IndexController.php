<?php

namespace workManagiment\Attendance\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');
        
        $modelAuth = new \workManagiment\Attendance\Models\Attendances();
       //$user= new \workManagiment\Attendances\Models\Attendances();
       
        print_r($modelAuth->gettodaylist());exit;
        $this->view->user = $user;
        
    }
    
    public function todaylistAction(){
       echo "Today list";exit;
        
    }

}

