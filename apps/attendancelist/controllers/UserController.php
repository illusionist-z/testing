<?php

namespace workManagiment\Attendancelist\Controllers;

use workManagiment\Core\Models\Db;

class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
       $this->assets->addJs('common/js/export.js');
       $this->assets->addJs('common/js/paging.js');
       $this->assets->addJs('apps/attendancelist/js/user-attendancelist.js');
        
        $this->view->t  = $this->_getTranslation();
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti = $User->GetUserNoti($id);
        $this->view->setVar("noti", $noti);
    }

    public function indexAction() {
        $user = $this->session->get('user');
        $this->view->user = $user;
    }

    /**
     * getting user attendance list by user id
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function attendancelistAction() {
        
        if (isset($this->session->tzoffset)) {
            $offset = $this->session->tzoffset['offset'];
            $timezone = $this->session->tzoffset['timezone'];
            $this->view->timezone = $timezone;
        } else {
            $offset = $this->session->location['offset'];
        }
        $startdate = $this->request->get('startdate');
        $enddate = $this->request->get('enddate');

        $id=$this->session->user['member_id'];
        $AttList = new \workManagiment\Attendancelist\Models\Attendances();
        $ResultAttlist = $AttList->getattlist($id, $startdate, $enddate);
        $this->view->attlist = $ResultAttlist;
        $this->view->offset = $offset;
    }

}
