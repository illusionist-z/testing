<?php

namespace workManagiment\Attendance\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();

        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');

        $attlist = new \workManagiment\Attendance\Models\Attendances();

        //get user attendance list for today
        $result_attlist = $attlist->gettodaylist();
        //get user name
        $username = $attlist->getusername();

        $this->view->attlist = $result_attlist;
        $this->view->uname = $username;
    }

    public function todaylistAction() {
        echo "Today list";
        exit;
    }

}
