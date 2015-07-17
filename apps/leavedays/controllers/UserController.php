<?php

use Phalcon\Config;

namespace workManagiment\Leavedays\Controllers;
use workManagiment\Core\Models\Db;
class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->assets->addJs('apps/leavedays/js/index.js');
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');        
        $user = $this->session->get('user');
        //$this->response->redirect('applyleave');        
    }

    public function applyleaveAction() {        
        require '../apps/Leavedays/Config/config.php';
        $config = $config;
        $leavetype = $config->leavetype;
        $this->view->setVar("Leavetype", $leavetype);
        if ($this->request->isPost()) {
            $sdate = $this->request->getPost('sdate');
            $edate = $this->request->getPost('edate');
            $type = $this->request->getPost('leavetype');
            $desc = $this->request->getPost('description');
            $id   = $this->session->user['member_id'];
            $applyleave = new \workManagiment\Leavedays\Models\Leaves();
            $applyleave->applyleave($id,$sdate, $edate, $type, $desc);            
            echo "<script type='text/javascript'>window.location.href='applyleave';</script>";
            $this->view->disable();
        }     
        
    }

    public function searchAction(){
        echo "searchAction";exit;
    }
      
    public function leavelistAction(){
     
       require '../apps/attendancelist/config/config.php';
        $month = $config->month;
        $leave = $config->leave;
        
        $id= $this->session->user['member_id'];
        
        //variable for search result
        $leave_type=$this->request->get('ltype');
        $mth = $this->request->get('month');
        
   
        
        $leaves = new \workManagiment\Leavedays\Models\Leaves();
        $leavelist = $leaves->getuserleavelist($leave_type,$mth,$id);
        //var_dump($leavelist);exit;
        $this->view->setVar("Result", $leavelist);
        $this->view->setVar("Month", $month);
      
        $this->view->setVar("leave_result", $leave);
        
        $this->view->setVar("Ltype", $leave_type);
        $this->view->setVar("Mth", $mth);
        $this->view->setVar("Uname", $username);
    }
  
}
        
