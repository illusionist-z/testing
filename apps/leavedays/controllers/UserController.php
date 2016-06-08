<?php

namespace salts\Leavedays\Controllers;

use salts\Leavedays\Models\Leaves as Leave;
use salts\Leavedays\Models\LeaveCategories as LeaveCategories;
use salts\Core\Models\Db;

class UserController extends ControllerBase {

    public $config = array();
    public $_leave;

    public function initialize() {
        parent::initialize();
        parent::getmodulename();
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        $this->setCommonJsAndCss();
        $this->setUserLeaveJsAndCss();
        $this->view->t = $this->_getTranslation();
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
         $this->permission = $this->setPermission($this->router->getModuleName());
        $this->view->permission = $this->permission;
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $User->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $User->GetUserNoti($id, 1);
            }
        } $this->view->setVar("Noti", $noti);
    }

    public function indexAction() {
        $this->session->get('user');
    }

    public function applyleaveAction() {
        if ($this->permission == 1) {
            $this->assets->addJs('common/js/jquery-ui-timepicker.js');
            $this->assets->addCss('common/css/jquery-ui-timepicker.css');
            $User = new Db\CoreMember;
            $admin_id = $User->GetAdminstratorId();
            $creator_id = $admin_id[0]['rel_member_id'];
            $id = $this->session->user['member_id'];
            $this->assets->addJs('apps/leavedays/js/user-applyleave.js');
            $LeaveType = new LeaveCategories();
            $ltype = $LeaveType->getLeaveType();
            $userlist = new Db\CoreMember();
            $this->view->setVar("Leavetype", $ltype);
            if ($this->request->isPost()) {
                $user = $this->_leave;
                $validate = $user->userValidation($this->request->getPost());
                if (count($validate)) {
                    foreach ($validate as $message) {
                        $json[$message->getField()] = $message->getMessage();
                    }
                    $json['result'] = "error";
                    echo json_encode($json);
                    $this->view->disable();
                } else {
                    $uname = $this->session->user['member_id'];
                    $sdate = $this->request->getPost('sdate');
                    $edate = $this->request->getPost('edate');
                    $type = $this->request->getPost('leavetype');
                    $desc = $this->request->getPost('description');
                    $error = $this->_leave->applyLeave($uname, $sdate, $edate, $type, $desc, $creator_id);
                    echo json_encode($error);
                    $this->view->disable();
                }
            }
        } else {
            echo 'Page Not Found';
        }
    }

    /**
     * 
     * display user leave list
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function leavelistAction() {
        if ($this->permission == 1) {
            $this->assets->addJs('common/js/paging.js');
            $this->assets->addJs('apps/leavedays/js/user-leavelist.js');
            $id = $this->session->user['member_id'];
            //month
            $month = $this->config['config']['month'];
            $LeaveType = new LeaveCategories();
            $ltype = $LeaveType->getLeaveType();
            $this->view->setVar("Leavetype", $ltype);
            $page = $this->request->get("page");
            //variable for search result
            $leave_type = $this->request->get('ltype');
            $mth = $this->request->get('month');            
            $absent_days = $this->_leave->getAbsentById($id);
            //get maximum leaves days
            $max = $this->_leave->getLeaveSetting();
            $max_leavedays = $max['0']['max_leavedays'];            
            $leave_list = $this->_leave->getUserLeaveList($leave_type, $mth, $id,$page);
            $this->view->setVar("Result", $leave_list);
            $this->view->setVar("absentdays", $absent_days);            
            $this->view->setVar("Month", $month);
            $this->view->setVar("Ltype", $leave_type);
            $this->view->setVar("Mth", $mth);
            $this->view->setVar("max", $max_leavedays);            
        } else {
            echo 'Page Not Found';
        }
    }

}
