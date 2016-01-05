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

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->view->t = $this->_getTranslation();
        $this->assets->addJs('apps/attendancelist/js/absent.js');
        $this->assets->addCss('common/css/css/style.css');
    }

      public function addAbsentAction() {

        $Attendance = new Attendance();
        $id = $this->request->get('id');
        $message = $Attendance->absent($id);
        echo json_encode($message);
        $this->view->disable();
        //$this->response->redirect('attendancelist/absent/absentlist');
    }

    public function absentlistAction() {
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $Admin->GetAdminNoti($id);
        
        $this->view->setVar("noti", $noti);
        $AbsentList = new \salts\Attendancelist\Models\Attendances();
        $Result = $AbsentList->GetAbsentList();
        $this->view->setVar('Result', $Result);
    }

}
