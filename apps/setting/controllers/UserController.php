<?php

namespace salts\Setting\Controllers;

use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;

class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/setting/js/user-changeprofile.js');
        $this->module_name = $this->router->getModuleName();
        $this->permission = $this->setPermission();
        $this->view->module_name = $this->module_name;
        $this->view->permission = $this->permission;
    }

    public function indexAction() {
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {

                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {

                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $this->view->setVar("noti", $Noti);

        $user = $Admin->userDetail($id);
        $profile = $Admin->getProfile($id);
        $this->view->userDetail = $user;
        $this->view->profile = $profile;
    }

    public function usersettingAction() {
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $Noti = $User->getUserNoti($id);
        $this->view->setVar("noti", $Noti);
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

           $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
        $file = fopen($MY_FILE, 'r');
        $file_contents = fread($file, filesize($MY_FILE));
        fclose($file);
        $file_contents = addslashes($file_contents);
        if($file_contents==NULL){
            $file_contents=$this->request->getPost('temp_profile');
        }
            $User = new \salts\Setting\Models\CoreMember();
            $User->updatedata($updatedata, $id,$file_contents);
            $user = $User->userData($id);
            $this->session->set('user', $user);
        }
        $this->response->redirect('setting/user');
    }

}
