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

    public $memberId;
  
 

    public function setmemberId($memberId) {
        $this->memberId = $memberId;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->permission = 1;
        $this->id = $this->session->user['member_id'];
        $this->act_name = 'attendancelist';
    }

    public function addAbsentAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $Attendance = new Attendance();
            $message = $Attendance->absent();
            var_dump($message);
            exit();
            echo json_encode($message);
        }
    }

    public function checkAttAction() {
        $this->initialize();
        $Attendace = new Attendance();
        $message = $Attendace->checkAttendance($this->id);
        return true;
    }

    public function absentlistAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $currentPage = $this->request->get('page');
            $Admin = new Db\CoreMember;
            $Noti = $Admin->getAdminNoti($this->id, 0);
            $AbsentList = new AttendancesTest();
            $Result = $AbsentList->GetAbsentList($currentPage);
            return true;
        }
    }

}
