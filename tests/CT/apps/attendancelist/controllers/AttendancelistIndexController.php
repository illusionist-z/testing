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

include_once 'tests\CT\apps\LoginForAll.php';
require_once 'apps/attendancelist/controllers/IndexController.php';
require_once 'apps/attendancelist/models/Attendances.php';
require_once 'apps/core/models/Permission.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class AttendancelistIndexController extends Controllers\IndexController {

    public $moduleIdCall;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");
    public $offset;
    public $id;

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
    }

    /**
     * show today attendance list
     * 
     */
    public function todaylistAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $this->act_name = $this->router->getModuleName();
            $currentPage = $this->request->get('page');
            $this->permission = $this->setPermission($this->act_name);
            $this->assets->addJs('common/js/jquery-ui-timepicker.js');
            $this->assets->addCss('common/css/jquery-ui-timepicker.css');
            $id = $this->session->user['member_id'];
            $name = $this->request->get('namelist');
            $offset = $this->session->location['offset'];
            $UserList = new \salts\Core\Models\Db\CoreMember();
            $Username = $UserList->getUserName();
            $AttList = new \salts\Attendancelist\Models\Attendances();
            $Result_Attlist = $AttList->getTodayList($name, $currentPage);

            if ($this->permission == 1) {
                $this->view->attlist = $Result_Attlist;
                $this->view->offset = $offset;
                $this->view->uname = $Username;
                $this->view->modulename = $this->module_name;
            }
        }
        return true;
    }

    public function editTimedialogAction($id) {
        $Att = new \salts\Attendancelist\Models\Attendances();
        $data = $Att->getAttTime($this->id);
        $data[1]['attlist'] = _("attendancelist");
        $data[1]['edit_att'] = _("edit_att_list");
        $data[1]['name'] = _("username");
        $data[1]['note'] = _("note");
        $data[1]['att_time'] = _("att_time");
        $data[1]['save'] = _("save");
        $data[1]['cancel'] = _("cancel");       
        return true;
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
    public function monthlylistAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $offset = $this->session->location['offset'];
            $currentPage = $this->request->get("page");

            $UserList = new \salts\Core\Models\CoreMember();
            // $UserName = $UserList::getinstance()->getusername();
            $month = $this->config->month;
            $Attendances = new \salts\Attendancelist\Models\Attendances();
            $monthly_list = $Attendances->showAttList($currentPage);
            //$coreid = new CorePermissionGroupId();

            if ($this->permission == 1) {
                $this->view->monthlylist = $monthly_list;
                $this->view->setVar("Month", $month);
                $this->view->setVar("Getname", $UserName);
                $this->view->setVar("offset", $offset);
            } else {
                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
        return true;
    }

    public function attsearchAction() {
        if ($this->request->isAjax() == true) {
            $month = $this->request->get('month');
            $username = $this->request->get('username', "string");
            $year = $this->request->get('year');
            $Attendances = new \salts\Attendancelist\Models\Attendances();
            $result = $Attendances->searchAttList($year, $month, $username);

            $this->view->disable();
            echo json_encode($result);
        }
        return true;
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * monthly attendance table show
     */
    public function attendancechartAction() {
        $Attendances = new \salts\Attendancelist\Models\Attendances();
        $currentPage = $this->request->get("page");

        $data = $Attendances->currentAttList($currentPage);

        return true;
    }

    public function autolistAction() {
        $UserList = new \salts\Auth\Models\CoreMember();
        $Username = $UserList->autoUsername();
        // $this->view->disable();
        // echo json_encode($Username);
        return true;
    }

}
