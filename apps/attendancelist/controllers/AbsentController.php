<?php

namespace workManagiment\Attendancelist\Controllers;

use workManagiment\Attendancelist\Models\Attendances as Attendance;
use workManagiment\Core\Models\Db;

/**
 * @desc     Get absent member 
 * @category member_id
 * @since    30/7/15
 */
class AbsentController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        $Attendance = new Attendance();
        $Attendance->absent();
        $this->view->disable();
    }

    public function absentlistAction() {
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id);
        ;
        $this->view->setVar("noti", $noti);
        $AbsentList = new \workManagiment\Attendancelist\Models\Attendances();
        $Result = $AbsentList->GetAbsentList();
        $this->view->setVar('Result', $Result);
    }

}
