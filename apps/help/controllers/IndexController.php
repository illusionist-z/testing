<?php

namespace salts\Help\Controllers;

use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;

//use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends ControllerBase {

    public $noti;

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/help/js/help.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('apps/help/css/help.css');
        $this->view->t = $this->_getTranslation();
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {

                $this->noti = $Admin->GetAdminNoti($id,0);
            }
            if ($key_name == 'show_user_notification') {
              
                $this->noti = $Admin->GetUserNoti($id,1);
            }
        }
        $this->view->setVar("noti", $this->noti);
    }

    /**
     * Search Help
     * @author Saw Zin Min Tun
     */
    public function searchHelpAction() {
        //echo "aa";exit;

        
    }

    public function dashboardAction() {
       
    }
    
   public function todayattlistAction() {
       
    }
    
     public function monthlyattlistAction() {
       
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
