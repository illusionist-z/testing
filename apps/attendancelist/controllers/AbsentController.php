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
    }

    public function addAbsentAction() {
        $Attendance = new Attendance();
        $message = $Attendance->absent();
        echo json_encode($message);
        $this->view->disable();
    }

    public function absentlistAction() {
        $currentPage = $this->request->get('page');
        $Admin = new Db\CoreMember;
        $Noti = $Admin->getAdminNoti($this->id,0);
        $this->view->setVar("Noti", $Noti);
        $AbsentList = new \salts\Attendancelist\Models\Attendances();
        $Result = $AbsentList->GetAbsentList($currentPage);
        $this->view->setVar('Result', $Result);
        
    }

}
