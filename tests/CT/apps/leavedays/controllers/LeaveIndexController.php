<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Manageuser\Models\User as User;
use salts\Core\Models\Db;
use salts\Leavedays\Controllers;
use salts\Leavedays\Models;
use salts\Leavedays\Models\Leaves as Leave;
use salts\Leavedays\Models\LeaveCategories as LeaveCategories;
use salts\Leavedays\Models\LeavesSetting as LeavesSetting;
use salts\Core\Models\Db\CoreMember;



/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class LeaveIndexController extends Controllers\IndexController {

    public $username;
    public $ltype_name;
    public $_leave;
    public $config;
    public $leaveday;
    public $status;
    public $info = array();
    public $id;
    public $noti_id;

    public function setId($id) {
        $this->id = $id;
    }

    public function setNoti($noti_id) {
        $this->noti_id = $noti_id;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setinfo($info) {
        $this->info = $info;
    }

    public function setltype_name($ltype_name) {
        $this->ltype_name = $ltype_name;
    }

    public function setusername($name) {
        $this->username = $name;
    }

    public function setmax_leavedays($leaveday) {
        $this->leaveday = $leaveday;
    }

    public function initialize() {

        $login = new LoginForAll();
        $login->loginFirst();
        $this->permission = 1;
        $this->moduleIdCall = 1;
        $this->currentPage = "leavelist";

        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays'); // get config data,@type module name
        $this->_leave = new Leave();
        $this->setCommonJsAndCss();
        $this->setLeaveJsAndCss();
        $Admin = new Db\CoreMember();
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($id, 1);
            }
        }
    }

    public function autolistAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $UserList = new Db\CoreMember();
            $username = $UserList->autoUsername();
            return true;
        }
    }

    public function getapplymemberidAction() {
        $this->initialize();
        $username = $this->username;

        $data = $this->username;

        $LeaveType = new models\LeaveCategories();
        $cond = $LeaveType->memberIdApplyLeave($data);
        return $cond;
    }

    public function applyleaveAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $LeaveType = new models\LeaveCategories();
            $ltype = $LeaveType->getLeaveType();
            $UserList = new Db\CoreMember();

            $name = $UserList::getinstance()->getusername("Ei Thandar Aung");
            if ($this->permission == 1) {

                return true;
            }
        }
    }

    public function checkapplyAction() {
        $this->initialize();
        $user = $this->_leave;
        $validate = $user->validating($this->request->getPost());
        if ($this->status == 1 && count($validate)) {
            foreach ($validate as $message) {
                $json[$message->getField()] = $message->getMessage();
            }
            $json['result'] = "error";
           
        } else {
            $creator_id = $this->session->user['member_id'];
            $uname = $this->info['uname'];
            $sdate = $this->info['sdate'];
            $edate = $this->info['edate'];
            $type = $this->info['type'];
            $desc = $this->info['desc'];
            $json = $this->_leave->applyLeave($uname, $sdate, $edate, $type, $desc, $creator_id);
            
        }

        return $json;
    }

    public function leavelistAction() {
        $this->initialize();

        if ($this->moduleIdCall == 1) {

            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];


            $noti = $Admin->GetAdminNoti($id, 0);

            $this->assets->addJs('apps/leavedays/js/search.js');
            $this->assets->addJs('apps/leavedays/js/index-leavelist.js');
            $LeaveType = new LeaveCategories();
            $ltype = $LeaveType->getLeaveType();

            $UserList = new Db\CoreMember();
            $GetUsername = $UserList::getinstance()->getusername("Ei Thandar Aung");
            $leaves = $this->_leave->getLeaveList($this->currentPage);
            $absent = $this->_leave->getAbsent();
            $max = $this->_leave->getLeaveSetting();
            $max_leavedays = $max['0']['max_leavedays'];

            if ($this->permission == 1) {

                return true;
            }
        }
    }

    public function leavesettingAction() {

        $this->initialize();

        if ($this->moduleIdCall == 1) {
            $Admin = new Db\CoreMember;
            $id = $this->session->user['member_id'];
            $noti = $Admin->GetAdminNoti($id, 0);

            $LeaveCategories = new LeaveCategories();
            $LeaveSetting = new LeavesSetting();
            $typelist = $LeaveCategories->getLeaveType();
            $setting = $LeaveSetting->getLeaveSetting();

            if ($this->permission == 1) {
                return $typelist;
            }
        }
    }

    public function deleteListTypeAction() {
        $this->initialize();
        $LeaveType = new LeaveCategories();
        $ltype = $LeaveType->getLeaveType();

        $leavetype_id = $ltype[0]['leavetype_id'];
        $LeaveCategories = new LeaveCategories();
        $LeaveCategories->deleteCategories($leavetype_id);
        return true;
    }

    public function addListTypeAction() {
        $this->initialize();
        $leavetype_name = $this->ltype_name;
        $LeaveCategories = new models\LeaveCategories();
        $LeaveCategories->addNewCategories($leavetype_name);
        return $leavetype_name;
    }

    public function editleavesettingAction() {
        $this->initialize();
        $max_leavedays = $this->leaveday;
        $LeaveSetting = new models\LeavesSetting();
        $LeaveSetting->editLeaveSetting($max_leavedays);
        $this->response->redirect('leavedays/index/leavesetting');
        return true;
    }

    public function acceptleaveAction() {
        $this->initialize();
        $id = $this->id;

        $days = $this->leaveday;

        $noti_id = $this->noti_id;


        $this->_leave->acceptLeave($id, $days, $noti_id);
        return true;
    }

    public function applyautolistAction() {
        $this->initialize();

        $UserList = new Db\CoreMember();
        $Username = $UserList->applyautousername();


        return true;
    }

    public function ltyaddAction() {
        $this->initialize();
        $data[1]['addleavetype'] = _("addleavetype");
        $data[1]['leave_category'] = _("leave_category");
        $data[1]['yes'] = _("yes");
        $data[1]['no'] = _("cancel");
        $data[1]['enterltp'] = _("enterltp");
        return $data;
    }

    public function ltypediaAction() {
        $this->initialize();
        $id = $this->id;
        $LeaveCategories = new LeaveCategories();
        $data[0] = $LeaveCategories->getListTypeData($id);
        $data[1]['delete_confirm'] = _("deleteleavetype");
        $data[1]['yes'] = _("yes");
        $data[1]['no'] = _("cancel");

        return $data;
    }

    public function detailAction() {
        $this->initialize();

        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $Admin = new Db\CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }


        $type = "detail";

        $Noti_id = $this->request->get('id');
        $module_name = "detail";

        $Noti_detail = new Leave();

        $Detail_result = $Noti_detail->getNotiInfo($module_name, $Noti_id);
        return true;
    }

    public function noleavelistAction() {
        $this->initialize();

        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/index-paging.js');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id, 0);

        $Result = $Admin->checkLeave();
        return true;
    }

    public function leavemostAction() {
        $this->initialize();

        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/leavedays/js/index-paging.js');
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id, 0);
        $Result = $Admin->leaveMost();
        return true;
    }

    public function rejectleaveAction() {
        $this->initialize();
        $this->_leave->rejectLeave($this->request->getPost('noti_id'));
        return true;
    }

}
