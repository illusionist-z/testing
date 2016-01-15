<?php

namespace salts\Notification\Controllers;

use salts\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->v = $this->module_name;
        $this->view->permission = $this->permission;
        $this->view->t = $this->_getTranslation();
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $permission = "admin";
            }
            if ($key_name == 'show_user_notification') {
                $permission = "user";
            }
        }



        $this->view->setVar("permission", $permission);
        //$this->assets->addJs('common/js/notification.js');
    }

    public function indexAction() {
        
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Show All Notification in one page
     */
    public function viewallAction() {
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $type = viewall;
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($id, 0);
                $oldnoti = $Admin->GetAdminNoti($id, 1);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($id, 1);
                $oldnoti = $Admin->GetUserNoti($id, 2);
            }
        }

        $this->view->setVar("noti", $noti);
        $this->view->setVar("oldnoti", $oldnoti);
        $this->view->setVar("type", $type);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * when user seen noti and click ok update data
     */
    public function update_notiAction() {
        $noti_id = $this->request->getPost('noti_id');
        $update = new \salts\Notification\Models\CoreNotificationRelMember();
        $update->updateNoti($noti_id);
    }

    public function notificationAction() {
        //echo "aa";exit;
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {

                $noti = $Admin->GetAdminNoti($id, 2);
            }
            if ($key_name == 'show_user_notification') {

                $noti = $Admin->GetUserNoti($id, 1);
            }
        }

        $type = 'noti';
        $this->view->setVar("noti", $noti);
        $this->view->setVar("type", $type);
    }

    public function detailAction() {
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $code = $this->session->permission_code;
        $Admin = new CoreMember();
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($id, 1);
            }
        }

        $this->view->setVar("noti", $noti);
        $type = "detail";
        $this->view->setVar("type", $type);
        $noti_id = $this->request->get('id');
        $module_name = $this->request->get('mname');
        $Noti_detail = new \salts\Notification\Models\CoreNotification();
        $Detail_result = $Noti_detail->GetNotiInfo($module_name, $noti_id);
        $this->view->setVar("module_name", $module_name);
        $this->view->setVar("result", $Detail_result);
        $this->view->t = $this->_getTranslation();
    }

    /**
     * notification for calendar
     * when someone add event on calendar
     */
    public function noticalendarAction() {

        $id = $this->request->get('id');
        $Noti = new \salts\Notification\Models\CoreNotification();
        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $Noti->calendarnotification($id);
            }
            if ($key_name == 'show_user_notification') {
                $member_id = $this->session->user['member_id'];
                $Noti->usercalendarnotification($id, $member_id);
            }
        }

        $this->response->redirect("calendar/index");
    }

    public function notiattendancesAction() {

        $id = $this->request->get('id');
        $Noti = new \salts\Notification\Models\CoreNotification();
        $Noti->attnotification($id);
        $this->response->redirect("attendancelist/index/todaylist");
    }

}
