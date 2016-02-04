<?php

namespace salts\Attendancelist\Controllers;

use salts\Core\Models\Db;

class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/attendancelist/js/user-attendancelist.js');
        $this->view->t = $this->_getTranslation();
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

        $id = $this->session->user['member_id'];
        $AttList = new \salts\Attendancelist\Models\Attendances();
        $ResultAttlist = $AttList->getattlist($id, $startdate, $enddate);
        $this->view->attlist = $ResultAttlist;
        $this->view->offset = $offset;
    }

}
