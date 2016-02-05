<?php

namespace salts\UserDashboard\Controllers;

use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;

class UserDashboardController extends ControllerBase {

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
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $Noti = $User->getUserNoti($id, 1);
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

            $updatedata['file'] = $updatedata['temp_file'];



            $User = new Db\CoreMember;
            $profile_pic = $User->updatedata($updatedata, $id);
            $user = $User->serData($id);
            $this->session->set('user', $user);
        }
        $this->response->redirect('setting/user/usersetting');
    }

}
