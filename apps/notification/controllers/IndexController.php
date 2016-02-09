<?php

namespace salts\Notification\Controllers;
use salts\Notification\Models\CoreNotificationRelMember;
use salts\Leavedays\Models\Leaves;
use salts\Attendancelist\Models\Attendances;
use salts\Notification\Models\CoreNotification;
use salts\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
     //   $this->view->v = $this->module_name;
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
                $Noti = $Admin->getAdminNoti($id, 0);
                $OldNoti = $Admin->getAdminNoti($id, 1);
            }
            if ($key_name == 'show_user_notification') {
                $Noti = $Admin->getUserNoti($id, 1);
                $OldNoti = $Admin->getUserNoti($id, 2);
            }
        }

        $this->view->setVar("Noti", $Noti);
        $this->view->setVar("old_noti", $OldNoti);
        $this->view->setVar("type", $type);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * when user seen noti and click ok update data
     */
    public function updateNotiAction() {
        
       $core = new CoreNotificationRelMember();
       $core = CoreNotificationRelMember::findFirst('noti_id =' . $this->request->getPost('noti_id'));
       $core->status = '2';
        $core->update();

        
    }

    public function notificationAction() {
      
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
        $this->view->setVar("Noti", $Noti);
        $this->view->setVar("type", $type);
    }

    public function detailAction() {
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

        $this->view->setVar("Noti", $Noti);
        $type = "detail";
        $this->view->setVar("type", $type);
        $Noti_id = $this->request->get('id');
        $module_name = $this->request->get('mname');
       
        $Noti_detail = new \salts\Notification\Models\CoreNotification();
        $Detail_result = $Noti_detail->getNotiInfo($Noti_id);
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
        $Noti = new CoreNotification();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $Noti = CoreNotification::findFirst('noti_id =' . $id);
                $Noti->noti_status='1';
                $Noti->update();
               
            }
            if ($key_name == 'show_user_notification') {
                   $member_id = $this->session->user['member_id'];
                 $Noti = CoreNotification::findFirst("noti_id = '" . $id . "' AND created_at =  '" . $member_id . "'");
                $Noti->noti_status='2';
                $Noti->update();
               
                $Noti->usercalendarNotification($id, $member_id);
            }
        }

        $this->response->redirect("calendar/index");
    }

    public function notiattendancesAction() {
        $core = new CoreNotification();
        $core = CoreNotification::findFirst('noti_id =' . $this->request->get('id'));
        $core->noti_status = '1';
        $core->update();
       
   
    }

}
