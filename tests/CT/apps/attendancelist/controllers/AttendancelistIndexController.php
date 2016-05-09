<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Manageuser\Models\User as User;
use salts\Core\Models\Db;
use salts\Attendancelist\Controllers;
use salts\Auth\Models;
use salts\Attendancelist\Models\CorePermissionGroupId;




/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 * edited by Khine Thazin Phyo
 */
class AttendancelistIndexController extends Controllers\IndexController {

    public $moduleIdCall;
    public $offset;
    public $id;

    public $db = array();

    public function setOffset($offset) {

        $this->offset = $offset;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();

        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');


        $CoreMember = new \salts\Core\Models\Db\CoreMember();
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $noti = $CoreMember->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $CoreMember->GetUserNoti($id, 1);
            }
        }
        $this->act_name = "todaylist";
        $this->module_name = "attendancelist";
        $this->permission = 1;
        $this->moduleIdCall = $CoreMember->ModuleIdSetPermission($this->module_name, $this->session->module);
    }

    /**
     * show today attendance list
     * 
     */
    public function todaylistAction($exportMode = null) {
        $this->initialize();
        if ($this->moduleIdCall == 1) {

            $currentPage = $this->request->get('page');

            $this->assets->addJs('common/js/jquery-ui-timepicker.js');
            $this->assets->addCss('common/css/jquery-ui-timepicker.css');
            $id = $this->session->user['member_id'];
            $name = $this->request->get('namelist');
            $offset = $this->session->location['offset'];
            $UserList = new \salts\Core\Models\Db\CoreMember();
            $Username = $UserList->getUserName("Khine Thazin Phyo");
            $AttList = new \salts\Attendancelist\Models\Attendances();
            $Result_Attlist = $AttList->getTodayList($name, $currentPage,0);

            if ($this->permission == 1) {
                return true;
            }
        }
    }

    public function editTimedialogAction($id) {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $Att = new \salts\Attendancelist\Models\Attendances();
            $data = $Att->getAttTime($id);
            $data[1]['attlist'] = _("attendancelist");
            $data[1]['edit_att'] = _("edit_att_list");
            $data[1]['name'] = _("username");
            $data[1]['note'] = _("note");
            $data[1]['att_time'] = _("att_time");
            $data[1]['save'] = _("save");
            $data[1]['cancel'] = _("cancel");
           
            return true;
        }
    }

    public function editTimeAction($id, $localtime) {
        $this->initialize();
        $post = $localtime;
        $Att = new \salts\Attendancelist\Models\Attendances();
        $Att->editAtt($post, $id, $this->offset);
        $this->response->redirect('attendancelist/index/todaylist');
        return true;
    }

    /**
     * show monthly attendancelist
     * 
     */
    public function monthlylistAction($exportMode = null) {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $offset = "-390";

            $currentPage = "monthlylist";
            $UserList = new \salts\Core\Models\CoreMember();

            $Attendances = new AttendancesTest();
            $monthly_list = $Attendances->showAttList($currentPage);


            if ($this->permission == 1) {
              
                return true;
            }
        }
    }

    public function attsearchAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $month = $this->request->get('month');
            $username = $this->request->get('username', "string");
            $year = $this->request->get('year');
            $Attendances = new \salts\Attendancelist\Models\Attendances();
            $result = $Attendances->searchAttList($year, $month, $username);
            echo json_encode($result);
        }
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * monthly attendance table show
     */
    public function attendancechartAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $Attendances = new AttendancesTest();
            $currentPage = $this->request->get("page");

            $data = $Attendances->currentAttList($currentPage);

            return true;
        }
    }

    public function autolistAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $UserList = new \salts\Auth\Models\CoreMember();
            $Username = $UserList->autoUsername();

            return true;
        }
    }

}
