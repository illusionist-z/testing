<?php

namespace salts\Help\Controllers;
use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;
//use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends  ControllerBase {

    public function initialize() {
   parent::initialize();
        $this->setCommonJsAndCss();        
        $this->assets->addJs('apps/dashboard/js/help.js');
        $this->view->t = $this->_getTranslation();
      
    }   
  /**
     * Search Help
     * @author Saw Zin Min Tun
     */
   public function searchHelpAction() {         
         //echo "aa";exit;
         $Admin=new CoreMember();
         $id = $this->session->user['member_id'];
         
                foreach ($this->session->auth as $key_name => $key_value) {
             
            if ($key_name == 'show_admin_notification') {
               
              $noti=$Admin->GetAdminNoti($id);
                 
            } 
            if ($key_name == 'show_user_notification') {
                //Go to admin dashboard
               //echo"aa";exit;
               $noti=$Admin->GetUserNoti($id); 
            }
        }

        $type='noti';        
        $this->view->setVar("noti",$noti);
    }
    
    
}
