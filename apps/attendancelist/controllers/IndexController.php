<?php

namespace workManagiment\Attendancelist\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Attendancelist\Models\Attendances;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addCss('common/css/pagination.css');
        $this->assets->addJs('apps/attendancelist/js/search-attsearch.js');
        $this->config = \Module_Config::getModuleConfig('leavedays');
    }

    /**
     * show today attendance list
     * @author zin mon
     */
    public function todaylistAction() {
        $this->assets->addJs('apps/attendancelist/js/index-todaylist.js');

        //get offset for location
        $offset = $this->session->location['offset'];

        $UserList = new Db\CoreMember();
        //Get user name for drop down 
        $Username = $UserList::getinstance()->getusername();
        $this->view->offset = $offset;
        $this->view->uname = $Username;
    }

    /**
     * Get today attendance list data and send json data
     * @author zin mon
     */
    public function showtodaylistAction() {
        $Attendance = new Attendances();
        $Attresult = $Attendance->gettodaylist();
        $this->view->disable();

        echo json_encode($Attresult);
    }

    /**
     * Show monthly attendance list gamen
     * @author zin mon
     */
    public function monthlylistAction() {
        $this->assets->addJs('apps/attendancelist/js/index-monthlylist.js');
        $offset = $this->session->location['offset'];
        $UserList = new Db\CoreMember();
        $UserName = $UserList::getinstance()->getusername();
        $month = $this->config->month;

        $this->view->setVar("Month", $month);
        $this->view->setVar("Getname", $UserName);
        $this->view->offset = $offset;
    }

    /**
     * get and show monthly attendance list
     * @author zin mon
     */
    public function showmonthlylistAction() {

        $Attendances = new Attendances();
        $monthlylist = $Attendances->showattlist();
        $this->view->disable();

        echo json_encode($monthlylist);
    }

}
