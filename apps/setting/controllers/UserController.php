<?php

namespace salts\Setting\Controllers;

use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;
class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/setting/js/user-changeprofile.js');
        $this->module_name =  $this->router->getModuleName();        
        $this->permission = $this->setPermission();             
        $this->view->module_name=$this->module_name;
        $this->view->permission = $this->permission;
    }

    public function indexAction() {
        $Admin=new Db\CoreMember;
         $id = $this->session->user['member_id'];
         
                foreach ($this->session->auth as $key_name => $key_value) {
             
            if ($key_name == 'show_admin_notification') {
                
              $noti=$Admin->GetAdminNoti($id,0);
                 
            } 
            if ($key_name == 'show_user_notification') {
                
               $noti=$Admin->GetUserNoti($id,1); 
            }
        }
    
        $this->view->setVar("noti",$noti);
        
        $user = $Admin->UserDetail($id);
        $this->view->userdetail = $user;
        
    }
 
  
    public function usersettingAction() {
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $User->GetUserNoti($id);
        $this->view->setVar("noti", $noti);
        $user = $User->UserDetail($id);
        $this->view->userdetail = $user;
    }
      
    /**
     * change profile 
     * user setting
     * @author Su Zin Kyaw
     */
    public function changeprofileAction() {
        if ($this->request->isPost()) {

            $updatedata = array();
            $updatedata = $this->request->getPost('member');
            $timezone = $this->request->getPost('timezone');
            if ($timezone != "0") {
                $arr = (explode(" ", $timezone));
                $sessiontz = $arr['1'];
                //convert +/- Hours to Seconds
                sscanf($sessiontz, "%d:%d:%d", $hours, $minutes, $seconds);
                $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                $s = ($time_seconds * -1);

                $this->session->set('tzoffset', array(
                    'offset' => $s,
                    'timezone' => $arr['2']
                ));
            }
            $id = $this->session->user['member_id'];

            $updatedata['file'] = $updatedata['temp_file'];



            $User = new Db\CoreMember;
            $profile_pic = $User->updatedata($updatedata, $id);
            $user = $User->Userdata($id);
            $this->session->set('user', $user);
        }
        $this->response->redirect('setting/user/usersetting');
    }

}
