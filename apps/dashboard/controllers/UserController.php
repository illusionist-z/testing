<?php

namespace salts\Dashboard\Controllers;

use salts\Core\Models\Db;

//use Phalcon\Flash\Direct as FlashDirect;

class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();        
        $this->setDashboardJsAndCss();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $Admin = new \salts\Auth\Models\Db\CoreMember;
        $id = $this->session->user['member_id'];
        if ($key_name == 'show_admin_notification') {
            $noti = $Admin->GetAdminNoti($id, 0);
        }
        if ($key_name == 'show_user_notification') {
            $noti = $Admin->GetUserNoti($id, 1);
        }
    }

    /**
     * 
     * Check User or Admin 
     */
    public function indexAction() {

        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $User->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $User->GetUserNoti($id, 1);
            }
        }
        $this->view->setVar("Noti", $noti);
        $Attendances = new \salts\Dashboard\Models\Attendances();
        $num_of_att = $Attendances->getAttList($id);
        $num_of_leaves = $Attendances->getTotalLeaves($id);
        $this->view->setVar("numatt", $num_of_att);
        $this->view->setVar("numleaves", $num_of_leaves);
        $this->view->t = $this->_getTranslation();
    }

}
