<?php

use salts\Core\Models\Db\CoreMember;
use salts\Dashboard\Models\CorePermissionGroup;
use salts\Dashboard\Controllers;
use salts\Core\Models\Db;

include_once 'tests\CT\apps\LoginForAll.php';
require_once 'apps/dashboard/controllers/IndexController.php';

class IndexControllerTest extends Controllers\IndexController {

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function adminAction() {
        $this->initialize();
        $CoreUser = new CorePermissionGroup();
        $core_groupuser2 = $CoreUser::find();

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

                return true;
            } else if ($key_name == 'user_dashboard') {

                $this->response->redirect('core/index');
                return true;
            }
        }
    }

    public function userAction() {
        $this->initialize();
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {
                $noti = $User->GetAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $User->GetUserNoti($id, 1);
            }
        }
        $Attendances = new \salts\Dashboard\Models\Attendances();
        $att_status = $Attendances->userAttLeave($id);
        return true;
    }

    public function checkinAction() {
        $this->initialize();
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $note = $this->request->get('note');
        $add = $this->session->location['location'];
        $offset = $this->session->location['offset'];
        $noti_Creatorid = $User->GetAdminstratorId();
        $creator_id = $noti_Creatorid[0]['rel_member_id'];
        $CheckIn = new \salts\Dashboard\Models\Attendances();
        $status = $CheckIn->setCheckInTime($id, $note, $add, $creator_id, $offset);
        return 'You have already check in';
    }

    public function checkoutAction() {
        $this->initialize();
        $id = $this->session->user['member_id'];
        $offset = $this->session->location['offset'];
        $CheckOut = new \salts\Dashboard\Models\Attendances();
        $status = $CheckOut->setCheckOutTime($id, $offset);
        $var = array();
        $var = $status;
        return $var;
    }

    public function location_sessionAction() {
        $this->initialize();
        $add = $this->request->get('location');
        $offset = $this->request->get('offset');
        $this->session->set('location', array(
            'location' => $add,
            'offset' => $offset
        ));
        return true;
    }

    public function directAction() {
        $this->initialize();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'admin_dashboard') {

                $this->response->redirect('attendancelist/index/todaylist');
                return $key_name;
            } else if ($key_name == 'user_dashboard') {
                $this->response->redirect('attendancelist/user/attendancelist');
                return $key_name;
            }
        }
    }

}
