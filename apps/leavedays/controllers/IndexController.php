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
        $this->assets->addCss('common/css/css/style.css');
        
        $this->assets->addJs('common/js/export.js');        
        $this->assets->addJs('apps/leavedays/js/index-leavesetting.js');    
        $this->assets->addJs('apps/leavedays/js/applyleave.js'); 
        $this->module_name =  $this->router->getModuleName();
        $this->permission = $this->setPermission();
        $this->view->t = $this->_getTranslation();
    }

    public function indexAction() {
        
    }

    public function leaveuserautolistAction() {
        //echo json_encode($result);
        $UserList = new Db\CoreMember();
        $Username = $UserList->leaveuserautolistusername();
        //print_r($UserList);exit;
        $this->view->disable();
        echo json_encode($Username);
    }

    /**
     * @author David
     * @type   $id,$sdate,$edate,$type,$desc
     * @desc   Apply Leave Action
     */
    public function applyleaveAction() {    
        $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$Admin->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
        $this->assets->addJs('apps/leavedays/js/applyleave.js');
        $leavetype = new LeaveCategories();
        $ltype=$leavetype->getleavetype();
        $userlist=new Db\CoreMember();
        
        $name = $userlist::getinstance()->getusername(); 
        if($this->permission==1){
        $this->view->setVar("name",$name);
        $this->view->setVar("Leavetype", $ltype);
        $this->view->modulename = $this->module_name;
        }
        else {
            $this->response->redirect('core/index');
        }
        if ($this->request->isPost()) {
            $user = $this->_leave;
            $validate = $user->validation($this->request->getPost());

            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";
                echo json_encode($json);
                $this->view->disable();
            } else {
                
                $creator_id = $this->session->user['member_id'];
                $uname = $this->request->getPost('username');
                $sdate = $this->request->getPost('sdate');
                $edate = $this->request->getPost('edate');
                $type = $this->request->getPost('leavetype');
                $desc = $this->request->getPost('description');
                $error = $this->_leave->applyleave($uname, $sdate, $edate, $type, $desc, $creator_id);

                echo json_encode($error);
                $this->view->disable();
            }
        }
    }

    /**
     * Show Leave data list
     */
    public function leavelistAction(){    
        $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$Admin->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/search.js');
        $this->assets->addJs('apps/leavedays/js/leavelist.js');
        $month = $this->config->month;
        $leavetype = new LeaveCategories();
        $ltype = $leavetype->getleavetype();

        $this->view->setVar("Leavetype", $ltype);
        $UserList = new Db\CoreMember();
        $GetUsername = $UserList::getinstance()->getusername();
        $leaves = $this->_leave->getleavelist();
        $max=$this->_leave->getleavesetting();
        $max_leavedays=$max['0']['max_leavedays'];
        if($this->permission==1){
        $this->view->max = $max_leavedays;
        $this->view->Getname = $GetUsername;
        $this->view->setVar("Result", $leaves);
        $this->view->setVar("Month", $month);
        $this->view->modulename = $this->module_name;
        }
        else {
            $this->response->redirect('core/index');
        }
    }
    
    public function leavesettingAction(){
        $Admin=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$Admin->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
        $LeaveCategories= new LeaveCategories();
        $LeaveSetting=new LeavesSetting();
        $typelist=$LeaveCategories->getleavetype();
        $setting=$LeaveSetting->getleavesetting();
        if($this->permission==1){
        $this->view->modulename = $this->module_name;
        $this->view->setVar("leave_typelist", $typelist);  
        $this->view->setVar("leave_setting", $setting); 
        }
        else {
            $this->response->redirect('core/index');
        }
    }

    public function ltypediaAction() {
        $id = $this->request->get('id');

        $LeaveCategories = new LeaveCategories();
        $data = $LeaveCategories->getltypedata($id);

        $this->view->disable();
        echo json_encode($data);
    }

    public function delete_ltypeAction() {
        $leavetype_id = $this->request->getPost('id');
        $LeaveCategories = new LeaveCategories();
        $LeaveCategories->delete_categories($leavetype_id);
        $this->view->disable();
    }

    public function add_ltypeAction() {
        $leavetype_name = $this->request->getPost('ltype_name');
        $LeaveCategories = new LeaveCategories();
        $LeaveCategories->add_newcategories($leavetype_name);
    }

    public function editleavesettingAction() {
        $max_leavedays = $this->request->getPost('max_leavedays');
        $fine_amount = $this->request->getPost('fine_amount');
        $LeaveSetting = new LeavesSetting();
        $LeaveSetting->editleavesetting($max_leavedays, $fine_amount);
        $this->response->redirect('leavedays/index/leavesetting');
    }

    public function acceptleaveAction() {
        //$sdate=$this->request->get('start_date');
        //$edate=$this->request->get('end_date');
        $id = $this->request->get('id');
        $days = $this->request->getPost('leave_days');
        $noti_id = $this->request->getPost('noti_id');
        $this->_leave->acceptleave($id, $days, $noti_id);
    }

    public function rejectleaveAction() {
//         $sdate=$this->request->get('start_date');
//        $edate=$this->request->get('end_date');
//        $id=$this->request->get('id');
//        $days=$this->request->getPost('leave_days');
        $noti_id = $this->request->getPost('noti_id');

        $this->_leave->rejectleave($noti_id);
    }

}
