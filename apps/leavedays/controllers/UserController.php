<?php

use Phalcon\Config;

namespace workManagiment\Leavedays\Controllers;
use workManagiment\Leavedays\Models\Leaves as Leave;
use workManagiment\Core\Models\Db;
class UserController extends ControllerBase {
    public $config;    
    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/leavedays/js/index.js');        
         $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/style.css');
        
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');        
        $user = $this->session->get('user');
        //$this->response->redirect('applyleave');        
    }

    public function applyleaveAction() {        
        $leavetype = $this->config->leavetype;        
        $this->view->setVar("Leavetype", $leavetype);
          if ($this->request->isPost()) {
            $uname = $this->request->getPost('uname');
            $sdate = $this->request->getPost('sdate');
            $edate = $this->request->getPost('edate');
            $type = $this->request->getPost('leavetype');
            $desc = $this->request->getPost('description');                     
            $error=$this->_leave->applyleave($uname,$sdate, $edate, $type, $desc); 
            $id = $this->session->user['member_id'];
            $User=new Db\CoreMember;
            $noti=$User->GetUserNoti($id);
            $this->session->set('noti', $noti);
            echo "<script>alert('".$error."');</script>";
            echo "<script type='text/javascript'>window.location.href='applyleave';</script>";
            $this->view->disable();
        }     
        
    }
     /**
     * 
     * display user leave list
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function leavelistAction(){          
        $month = $this->config->month;
        $leave = $this->config->leavetype; 
        
        $id= $this->session->user['member_id'];
        
        //variable for search result
        $leave_type=$this->request->get('ltype');
        $mth = $this->request->get('month');             
        $leavelist = $this->_leave->getuserleavelist($leave_type,$mth,$id); 
      
        $this->view->setVar("Result", $leavelist);
        $this->view->setVar("Month", $month);      
        $this->view->setVar("leave_result", $leave);
        
        $this->view->setVar("Ltype", $leave_type);
        $this->view->setVar("Mth", $mth);
        $this->view->setVar("Uname", $username);
    }
  
}
      
