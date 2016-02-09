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

    public $id;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->view->t = $this->_getTranslation();
        $this->id = $this->session->user['member_id'];
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/attendancelist/js/absent.js');
        $this->assets->addCss('common/css/css/style.css');
    }

    public function addAbsentAction() {

        $Attendance = new Attendance();
        $message = $Attendance->absent();
        echo json_encode($message);
        $this->view->disable();
    }

    public function absentlistAction() {
        $Admin = new Db\CoreMember;
        $Noti = $Admin->getAdminNoti($this->id);
        $this->view->setVar("Noti", $Noti);
        $AbsentList = new \salts\Attendancelist\Models\Attendances();
        $Result = $AbsentList->GetAbsentList();
        $this->view->setVar('Result', $Result);
    }

}
