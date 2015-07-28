<?php
namespace workManagiment\Leavedays\Controllers;
use workManagiment\Core\Models\Db;
use workManagiment\Leavedays\Models\Leaves as Leave;
class IndexController extends ControllerBase {
    public $_leave;
    public $config;    
    public function initialize() {                       
        $this->config = \Module_Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        parent::initialize();        
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/leavedays/js/leave.js');
    }

    public function indexAction() {
        
    }
    /**
     * @author David
     * @type   $id,$sdate,$edate,$type,$desc
     * @desc   Apply Leave Action
     */
    public function applyleaveAction() {               
        $leavetype = $this->config->leavetype;
        $userlist=new Db\CoreMember();
        $name = $userlist::getinstance()->getusername();           
        $this->view->setVar("name",$name);
        $this->view->setVar("Leavetype", $leavetype);
        if ($this->request->isPost()) {
            $uname = $this->request->getPost('uname');
            $sdate = $this->request->getPost('sdate');
            $edate = $this->request->getPost('edate');
            $type = $this->request->getPost('leavetype');
            $desc = $this->request->getPost('description');                     
            $error=$this->_leave->applyleave($uname,$sdate, $edate, $type, $desc);            
            echo "<script>alert('".$error."');</script>";
            echo "<script type='text/javascript'>window.location.href='applyleave';</script>";
            $this->view->disable();
        }                       
    }
  
    /**
     * Show Leave data list
     */
    public function leavelistAction(){              
        $month = $this->config->month;
        $leave = $this->config->leavetype;        
        $userlist=new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();                   
        $leaves = $this->_leave->getleavelist();               
        $this->view->setVar("Result", $leaves);
        $this->view->setVar("Month", $month);
        $this->view->setVar("Getname", $user_name);
        $this->view->setVar("leave_result", $leave);        

    }
    
   
    
    public function decideAction(){
         $type=$this->request->getPost('submit');
        $sdate=$this->request->getPost('start_date');
        $id=$this->request->getPost('member_id');
        
        if($type=='Yes'){
           
             $this->_leave->acceptleave($id,$sdate); 
        }
        else{
            $this->_leave->rejectleave($id,$sdate); 
        }
        
    }
}
