<?php

namespace salts\Help\Controllers;

use salts\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase {

    public $Noti;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setHelpJsAndCss();
        $this->view->t = $this->_getTranslation();
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $this->noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $this->noti = $Admin->getUserNoti($id, 1);
            }
        }
        $this->view->setVar("noti", $this->noti);
    }

    /**
     * Search Help
     * @author Saw Zin Min Tun
     */
    public function searchHelpAction() {
        
    }

    public function dashboardAction() {
        
    }

    public function todayattlistAction() {
        
    }

    public function monthlyattlistAction() {
        
    }

    public function monthlyattchartAction() {
        
    }

    public function manageuserAction() {
        
    }

    public function applyleaveAction() {
        
    }

    public function leavelistsAction() {
        
    }

    public function leavesettingAction() {
        
    }

    public function addsalaryAction() {
        
    }

    public function salarylistsAction() {
        
    }

    public function monthlysallistsAction() {
        
    }

    public function salarysettingAction() {
        
    }

    public function allowanceAction() {
        
    }

    public function calendarAction() {
        
    }

    public function letterheadAction() {
        
    }

    public function ssbdocumentAction() {
        
    }

    public function taxdocumentAction() {
        
    }

}
