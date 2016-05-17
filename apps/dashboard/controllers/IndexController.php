<?php

namespace salts\Dashboard\Controllers;

use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;
use salts\Dashboard\Models\CorePermissionGroup;

date_default_timezone_set('UTC');

//use Phalcon\Flash\Direct as FlashDirect;


class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize(); 
       
        $this->setDashboardJsAndCss();
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $Admin = new Db\CoreMember();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($this->session->user['member_id'], 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($this->session->user['member_id'], 1);
            }
        }
        $this->view->setVar("Noti", $noti);
        $this->view->module_name = $this->router->getModuleName();
        $this->view->t = $this->_getTranslation();
        $this->permission = $this->setPermission($this->router->getModuleName());
        $this->view->permission = $this->permission;
        $moduleIdCallCore = new Db\CoreMember();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->router->getModuleName(), $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
       // Module ID Filter Start By (Module Name)        
        //$this->view->module_name_view = $this->module_name;
        $this->module_id_set = $this->session->module;
        $this->view->module_id_set = $this->module_id_set;
   
    }

    /**
     * 
     * Check User or Admin 
     */
    public function indexAction() {
        $this->view->disable();
        $this->response->redirect('dashboard/index/user');
    }

    /**
     * show admin dashboard
     * @author david
     * get last created member name
     * @type array {$gname}
     */
    public function adminAction() {
 
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
        $this->view->setVar("Noti", $noti);
        //get last create member
        $CMember = new CoreMember();
        $Get_Name = $CMember::getinstance()->getlastname();
        $new_member = count($Get_Name);
        //get most leave name
        $CheckLeave = new \salts\Dashboard\Models\Attendances();
        $leave_name = $CheckLeave->checkLeave();
        $status = $CheckLeave->todayAttLeave();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'admin_dashboard') {
                $this->view->setVar("attname", $status['att']);
                $this->view->setVar("absent", $status['absent']);
               // $this->view->setVar("nlname", $leave_name['noleave_name']);  //get current month no taken leave name
                if(sizeof($leave_name['noleave_name']) != 0){
                        $this->view->setVar("nlname", $leave_name['noleave_name']); 
                }else{
                    $this->view->setVar("nlname", $leave_name['noleave_least']);
                }
               // var_dump(sizeof($leave_name['noleave_name']));exit;
                $this->view->setVar("lname", $leave_name['leave_name']);
                $this->view->setVar("name", $Get_Name);
                $this->view->setVar("newnumber", $new_member);
                $this->view->t = $this->_getTranslation();
            } else if ($key_name == 'user_dashboard') {
                $this->view->disable();
                $this->response->redirect('core/index');
            }
        }
    }

    /**
     * show user dashboard
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * 
     */
    public function userAction() {
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        foreach ($this->session->auth as $key_name => $key_value) {
            echo $key_name;
            if ($key_name == 'show_admin_notification') {
                $noti = $User->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $User->GetUserNoti($id, 1);
            }
        }
        $this->view->setVar("Noti", $noti);
        $Attendances = new \salts\Dashboard\Models\Attendances();
        $att_status = $Attendances->userAttLeave($id);
        $this->view->setVar("numatt", $att_status['att']);
        $this->view->setVar("numleaves", $att_status['absent']);
        $this->view->t = $this->_getTranslation();
    }

    /**
     * set location,latitude and longitude to session
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function location_sessionAction() {
        $add = $this->request->get('location');
        $offset = $this->request->get('offset');
        $this->session->set('location', array(
            'location' => $add,
            'offset' => $offset
        ));
    }

    /**
     * Check In Action
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function checkinAction() {
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $note = $this->request->get('note');
        $add = $this->session->location['location'];
        $offset = $this->session->location['offset'];
        $noti_Creatorid = $User->GetAdminstratorId();
        $creator_id = $noti_Creatorid[0]['rel_member_id'];
        $CheckIn = new \salts\Dashboard\Models\Attendances();
        $status = $CheckIn->setCheckInTime($id, $note, $add, $creator_id, $offset);
        $this->view->disable();
        echo json_encode($status);
    }

    /**
     * Check out
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function checkoutAction() {
        $id = $this->session->user['member_id'];
        $offset = $this->session->location['offset'];
        $CheckOut = new \salts\Dashboard\Models\Attendances();
        $status = $CheckOut->setCheckOutTime($id, $offset);
        $this->view->disable();
        echo json_encode($status);
    }

    /**
     * define user or admin
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function directAction() {
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'admin_dashboard') {
                $this->view->disable();
                
                $this->response->redirect('attendancelist/index/todaylist');
            } else if ($key_name == 'user_dashboard') {
                $this->view->disable();
                $this->response->redirect('attendancelist/user/attendancelist');
            }
        }
    }

}
