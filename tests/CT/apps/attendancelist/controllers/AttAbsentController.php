<<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use salts\Core\Models\Db;
use salts\Attendancelist\Controllers;
use salts\Attendancelist\Models\Attendances as Attendance;


include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/attendancelist/controllers/AbsentController.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class AttAbsentController extends Controllers\AbsentController {

    public $moduleIdCall;
    public $Attendance;
    public $memberId;
    public $id;
    public $ID;
    public $view;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");

    public function setmemberId($memberId) {
        $this->memberId = $memberId;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function addAbsentAction() {
        $this->permission = 1;
       if ($this->permission == 1) {
            $Attendance = new Attendance();
            $message = $Attendance->absent();
            echo json_encode($message);
         
        } else {
            echo 'Page Not Found';
        }
    }
    public function absentlistAction() {
        $this->initialize();
        $currentPage = $this->request->get('page');
        $Admin = new Db\CoreMember;
        $Noti = $Admin->getAdminNoti($this->ID, 0);
        $AbsentList = new \salts\Attendancelist\Models\Attendances();
        $Result = $AbsentList->GetAbsentList($currentPage);
        return true;
    }

}
