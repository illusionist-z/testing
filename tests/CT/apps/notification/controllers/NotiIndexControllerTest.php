<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author Ei Thandar Aung 
 */
use salts\Notification\Controllers;
use salts\Notification\Models\CoreNotificationRelMember;
use salts\Notification\Models\CoreNotification;
use salts\Core\Models\Db\CoreMember;

class NotiIndexControllerTest extends Controllers\IndexController {

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->act_name = "notification";
        $this->permission = 1;
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $permission = "admin";
            }
            if ($key_name == 'show_user_notification') {
                $permission = "user";
            }
        }
    }

    public function notificationAction() {
        $this->initialize();
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {

                $Noti = $Admin->getAdminNoti($id, 2);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $type = 'noti';

        return true;
    }

    public function detailAction() {
        $this->initialize();
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $type = "detail";

        $Noti_id = $Noti[0]["noti_id"];
        $module_name = $Noti[0]["module_name"];
        $Noti_detail = new \salts\Notification\Models\CoreNotification();
        $Detail_result = $Noti_detail->getNotiInfo($Noti_id);

        return true;
    }

    public function notiattendancesAction() {
        $this->initialize();
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $core = new CoreNotification();
        $core = CoreNotification::findFirst('noti_id =' . $Noti[0]["noti_id"]);
        $core->noti_status = '1';
        $core->update();
        $this->response->redirect("attendancelist/index/todaylist");
        return true;
    }

    public function viewallAction() {
        $this->initialize();

        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $type = "viewall";


        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
                $OldNoti = $Admin->getAdminNoti($id, 1);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
                $OldNoti = $Admin->getUserNoti($id, 2);
            }
        }

        return true;
    }

    public function updateNotiAction() {
        $this->initialize();
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
            }
        }
        $core = new CoreNotificationRelMember();
        $core->updateNoti($Noti[0]["noti_id"]);
        return true;
    }

}
