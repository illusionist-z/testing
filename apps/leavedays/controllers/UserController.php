<?php

use Phalcon\Config;

namespace salts\Leavedays\Controllers;

use salts\Leavedays\Models\Leaves as Leave;
use salts\Leavedays\Models\LeaveCategories as LeaveCategories;
use salts\Core\Models\Db;

class UserController extends ControllerBase {

    public $config;
    public $_leave;

    public function initialize() {
        parent::initialize();
        parent::getmodulename();
        $this->config = \Module_Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/export.js');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->view->t = $this->_getTranslation();
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $User->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $User->getUserNoti($id, 1);
            }
        } $this->view->setVar("noti", $Noti);
    }

    public function indexAction() {
        $user = $this->session->get('user');
    }

    public function applyleaveAction() {
        $this->assets->addJs('common/js/jquery-ui-timepicker.js');
        $this->assets->addCss('common/css/jquery-ui-timepicker.css');
        $User = new Db\CoreMember;
        $admin_id = $User->GetAdminstratorId();
        $creator_id = $admin_id[0]['rel_member_id'];
        $id = $this->session->user['member_id'];
        $this->assets->addJs('apps/leavedays/js/user-applyleave.js');
        $leavetype = new LeaveCategories();
        $ltype = $leavetype->getleavetype();
        $userlist = new Db\CoreMember();
        $name = $userlist::getinstance()->getusername();
        $this->view->setVar("name", $name);
        $this->view->setVar("Leavetype", $ltype);
        if ($this->request->isPost()) {
            $user = $this->_leave;
            $validate = $user->uservalidation($this->request->getPost());
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
                $error = $this->_leave->applyleave($uname, $sdate, $edate, $type, $desc, $creator_id);
                echo json_encode($error);
                $this->view->disable();
            }
        }
    }

    /**
     * 
     * display user leave list
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function leavelistAction() {
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/user-leavelist.js');
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        //month
        $month = $this->config->month;
        $leavetype = new LeaveCategories();
        $ltype = $leavetype->getleavetype();
        $this->view->setVar("Leavetype", $ltype);

        //variable for search result
        $leave_type = $this->request->get('ltype');
        $mth = $this->request->get('month');
        $leavelist = $this->_leave->getuserleavelist($leave_type, $mth, $id);

        $absentdays = $this->_leave->getabsentbyId($id);
        $this->view->setVar("Result", $leavelist);
        $this->view->setVar("absentdays", $absentdays);
        //get maximum leaves days
        $max = $this->_leave->getleavesetting();
        $max_leavedays = $max['0']['max_leavedays'];
        $this->view->setVar("Month", $month);

        $this->view->setVar("Ltype", $leave_type);
        $this->view->setVar("Mth", $mth);
        $this->view->setVar("max", $max_leavedays);
    }

}
