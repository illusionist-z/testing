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
    
    public function leavelistAction(){
       require '../apps/attendancelist/config/config.php';
        $month = $config->month;
        $leave = $config->leave;
        
        $users =new \workManagiment\Leavedays\Models\CoreMember();
        $user_name = $users->getusername();
        
        //variable for search result
        $leave_type=$this->request->get('ltype');
        $mth = $this->request->get('month');
        $username = $this->request->get('username');
        
        $leaves = new \workManagiment\Leavedays\Models\Leaves();
        $leaves = $leaves->getleavelist($leave_type,$mth,$username);
               
        $this->view->setVar("Result", $leaves);
        $this->view->setVar("Month", $month);
        $this->view->setVar("Getname", $user_name);
        $this->view->setVar("leave_result", $leave);
        
        $this->view->setVar("Ltype", $leave_type);
        $this->view->setVar("Mth", $mth);
        $this->view->setVar("Uname", $username);
    }
  
}

