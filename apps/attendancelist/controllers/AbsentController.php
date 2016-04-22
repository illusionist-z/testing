<?php

namespace salts\Attendancelist\Controllers;

use salts\Attendancelist\Models\Attendances as Attendance;
use salts\Core\Models\Db;

/**
 * @desc     Get absent member 
 * @category member_id
 * @since    30/7/15
 */
class AbsentController extends ControllerBase {

    // public $id;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setAttAbsentJsAndCss();
        $this->view->t = $this->_getTranslation();
        $this->id = $this->session->user['member_id'];
        $this->module_name = $this->router->getModuleName();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->permission = $this->permission;
        $this->view->module_name = $this->module_name;
    }

    public function addAbsentAction() {
        if ($this->permission == 1) {
            $Attendance = new Attendance();
            $message = $Attendance->absent();
            echo json_encode($message);
            $this->view->disable();
        } else {
            echo 'Page Not Found';
        }
    }
    /**
     * @author David JP <david.gnext@gmail.com>
     * @return json [1 || 0]
     */
    public function checkAttAction(){
        $Attendace = new Attendance();
        $message = $Attendace->checkAttendance($this->id);
        $this->view->disable();
        echo json_encode($message);
    }

    public function absentlistAction() {
        if ($this->permission == 1) {
            $currentPage = $this->request->get('page');
            $Admin = new Db\CoreMember;
            $Noti = $Admin->getAdminNoti($this->id, 0);
            $this->view->setVar("Noti", $Noti);
            $AbsentList = new \salts\Attendancelist\Models\Attendances();
            $Result = $AbsentList->GetAbsentList($currentPage);
            $this->view->setVar('Result', $Result);
        } else {
            echo "Page Not Found";
        }
    }

}
