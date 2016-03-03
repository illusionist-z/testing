<?php

namespace salts\Calendar\Controllers;

use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase {

    public $Calendar;

    public function initialize() {
        parent::initialize();
        $this->Calendar = new \salts\Calendar\Models\Calendar();
        $this->setCommonJsAndCss();
        $this->setCalJsAndCss();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->permission = $this->permission;
        $this->view->t = $this->_getTranslation();
        $moduleIdCallCore = new Db\CoreMember();
        $this->module_name = $this->router->getModuleName();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
    }

    public function indexAction() {
        $Admin = new Db\CoreMember;
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
        $GetMember = new Db\CoreMember();
        $permit_name = $this->Calendar->getalluser($id);
        $AllName = $GetMember::getinstance()->getusername();
        $this->view->event_name = $permit_name;
        $this->view->member_name = $this->session->user['member_login_name'];
        $this->view->uname = $AllName;
        $this->view->modulename = $this->module_name;
    }

    //calender auto complete  for username
    public function calenderautoAction() {
        $UserList = new Db\CoreMember();
        $Username = $UserList->autousername();
        echo json_encode($Username);
        $this->view->disable();
    }

    /**
     * 
     * get member_id 

     */
    public function getcalmemberidAction() {
        $data = $this->request->get('uname');
        $cond = $this->Calendar->memIdCal($data);
        echo json_encode($cond);
        $this->view->disable();
    }

    public function addmemberAction() {
        $permit_name = $this->request->get("permit");
        $id = $this->session->user['member_id'];
        $data = ($permit_name == $id ? 1 : $this->Calendar->addPermitName($permit_name, $id));
        echo json_encode($data);
        $this->view->disable();
    }

    public function removeEventBynameAction() {
        $remove = $this->request->getPost('remove');
        $id = $this->session->user['member_id'];
        $data = $this->Calendar->removeMember($remove, $id);
        echo json_encode($data);
        $this->view->disable();
    }

    /**
     * @desc calendar event show
     * @author david
     * @since 27/7/15
     */
    public function showdataAction() {
        $id = $this->request->get('event_id');
        $this->view->disable();
        $events = $this->Calendar->fetch($id);
        echo json_encode($events);
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @category create event
     * @return   json { error message }
     */
    public function createAction() {
        $this->view->disable();
        $uname = $this->request->get('uname');
        $member_id = $this->request->get('member_id');
        $sdate = $this->request->get('sdate');
        $edate = $this->request->get('edate');
        $title = $this->request->get('title');
        //$coremember = new Db\CoreMember();
        $creator_id = $this->session->user['member_id'];
        $creator_name = $this->session->user['member_login_name'];
        $res = array();
        if ($title == null) {
            $res['cond'] = FALSE;
            $res['title'] = "Title not be empty";
        } else if ($uname == null) {
            $res['cond'] = FALSE;
            $res['name'] = "Name must be insert";
        } else if (strtotime($sdate) > strtotime($edate)) {
            $res['cond'] = FALSE;
            $res['date'] = "End date must be greater than start date";
        } else {
            $res['cond'] = TRUE;
            $event = $this->Calendar->createEvent($member_id, $creator_name, $creator_id, $sdate, $edate, $title, $uname);
            $res['res'] = $event;
            $res['name'] = $uname;
        }
        echo json_encode($res);
    }

    /**
     * @author   David
     * @category edit event
     * @return   json { error message }
     */
    public function editAction($id, $e = null) {
        $this->view->disable();
        $member_id = $this->session->user['member_id'];
        $sdate = $this->request->get('sdate');
        $edate = $this->request->get('edate');
        null === $e ? $edate = date('Y-m-d H:i:s', strtotime($edate . '-1 days')) : $edate;
        $name = $this->request->get('uname');
        $title = $this->request->get('title');
        $res = array();
        if ($title == null) {
            $res['cond'] = FALSE;
            $res['res'] = "title not be empty";
        } else if (strtotime($sdate) > strtotime($edate)) {
            $res['cond'] = FALSE;
            $res['date'] = "End date must be greater than start date";
        } else {
            $res['cond'] = TRUE;
            $edit = $this->Calendar->editEvent($name, $sdate, $edate, $title, $id, $member_id);
            $res['res'] = $edit;
            $res['name'] = $name;
        }
        echo json_encode($res);
    }

    /**
     * @desc Delete event
     * @author David
     * @since 27/7/15
     */
    public function deleteAction() {
        $this->view->disable();
        $id = $this->request->get('data');
        $this->Calendar->deleteEvent($id);
    }

    public function getidAction() {
        $this->view->disable();
        $id = $this->request->get('id');
        $result = $this->Calendar->getIdName($id);
        echo json_encode($result);
    }

}
