<?php
namespace workManagiment\Leavedays\Controllers;
use workManagiment\Core\Models\Db;
use workManagiment\Leavedays\Models\Leaves as Leave;
use workManagiment\Leavedays\Models\LeaveCategories as LeaveCategories;
use workManagiment\Leavedays\Models\LeavesSetting as LeavesSetting;
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
        $this->assets->addJs('apps/leavedays/js/index_leavelist.js');
        $this->assets->addJs('apps/leavedays/js/leavesetting.js');
        
    }

    public function indexAction() {
        
    }
    /**
     * @author David
     * @type   $id,$sdate,$edate,$type,$desc
     * @desc   Apply Leave Action
     */
    public function applyleaveAction() {               
        $leavetype = new LeaveCategories();
        $ltype=$leavetype->getleavetype();
        $userlist=new Db\CoreMember();
        
        $name = $UserList::getinstance()->getusername();           
        $this->view->setVar("name",$name);
        $this->view->setVar("Leavetype", $ltype);
        if ($this->request->isPost()) {
            $uname = $this->session->user['member_id'];
            $sdate = $this->request->getPost('sdate');
            $edate = $this->request->getPost('edate');
            $type = $this->request->getPost('leavetype');
            $desc = $this->request->getPost('description');                     
            $error=$this->_leave->applyleave($uname,$sdate, $edate, $type, $desc);   
            $noti=$userlist->GetAdminNoti();
            $this->session->set('noti', $noti);
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
        $UserList=new Db\CoreMember();
        $GetUsername = $UserList::getinstance()->getusername();                   
        $leaves = $this->_leave->getleavelist();               
        $this->view->setVar("Result", $leaves);
        $this->view->setVar("Month", $month);
        $this->view->setVar("Getname", $GetUsername);
        $this->view->setVar("leave_result", $leave);        

    }
    
   
    
    public function decideAction(){
         $type=$this->request->getPost('submit');
        $sdate=$this->request->getPost('start_date');
        $edate=$this->request->getPost('end_date');
        $id=$this->request->getPost('member_id');
        $days=$this->request->getPost('days');
       
        if($type=='Yes'){
            
             $this->_leave->acceptleave($id,$sdate,$edate,$days); 
        }
        else{
            $this->_leave->rejectleave($id,$sdate); 
        }
        $this->response->redirect('dashboard/index');
    }
    
    public function leavesettingAction(){
        $LeaveCategories= new LeaveCategories();
        $LeaveSetting=new LeavesSetting();
        $typelist=$LeaveCategories->getleavetype();
        $setting=$LeaveSetting->getleavesetting();
        
        $this->view->setVar("leave_typelist", $typelist);  
        $this->view->setVar("leave_setting", $setting);  
    }
    
    public function ltypediaAction(){
        $id=$this->request->get('id'); 
       
        $LeaveCategories=new LeaveCategories();
        $data=$LeaveCategories->getltypedata($id);
        
        $this->view->disable();
        echo json_encode($data);
    }
    
    public function delete_ltypeAction(){
       $leavetype_id =$this->request->getPost('id');
        $LeaveCategories=new LeaveCategories();
        $LeaveCategories->delete_categories($leavetype_id);
        $this->view->disable();
    }
    
    public function add_ltypeAction(){
        $leavetype_name=$this->request->getPost('ltype_name');
        $LeaveCategories=new LeaveCategories();
        $LeaveCategories->add_newcategories($leavetype_name);
    }
    
    public function editleavesettingAction(){
        $max_leavedays=$this->request->getPost('max_leavedays');
        $fine_amount=$this->request->getPost('fine_amount');
        $LeaveSetting=new LeavesSetting();
        $LeaveSetting->editleavesetting($max_leavedays,$fine_amount);
        $this->response->redirect('leavedays/index/leavesetting');

    }
}
