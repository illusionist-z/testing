<?php

namespace salts\Attendancelist\Controllers;

use salts\Attendancelist\Models\Attendances as Attendance;
use salts\Core\Models\Db;
$server = PHP_OS;

if($server == 'Linux'){
 include_once '/var/www/html/salts/apps/core/models/db/CoreMember.php';
 include_once '/var/www/html/salts/apps/core/models/CoreMember.php';
    }
/**
 * @desc     Get absent member 
 * @category member_id
 * @since    30/7/15
 */
class AbsentController extends ControllerBase {

    public $id;

    public function initialize() {
        parent::initialize();
         $server = PHP_OS;
     if($server == 'Linux'){
         
        $this->assets->addCss('common/css/bootstrap/bootstrap.min.css');
        $this->assets->addCss('common/css/bootstrap.min.css');
        $this->assets->addCss('common/css/common.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/skins.min.css');
        $this->assets->addJs('common/js/jquery.min.js');
        $this->assets->addJs('common/js/common.js');
                //->addJs('common/js/btn.js')
        $this->assets->addJs('common/js/bootstrap.min.js');
        $this->assets->addJs('common/js/app.min.js');
        $this->assets->addJs('common/js/jquery-ui.js');
        $this->assets->addJs('common/js/notification.js');
        //$this->setDashboardJsAndCss();
     }
     else { 
         
         $this->setCommonJsAndCss();
     
     }
        //$this->setAttAbsentJsAndCss();
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
        $Admin = new Db\CoreMember;
        $Noti = $Admin->getAdminNoti($this->id);
        $this->view->setVar("Noti", $Noti);
        $AbsentList = new \salts\Attendancelist\Models\Attendances();
        $Result = $AbsentList->GetAbsentList();
        $this->view->setVar('Result', $Result);
    }

}
