<?php

namespace salts\Attendancelist\Controllers;

use salts\Core\Models\Db;
use salts\Attendancelist\Models\Attendances;

class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
    }

    public function indexAction() {
        
    }

    /**
     * Search attendance list
     * 
     */
    public function attsearchAction() {
        if ($this->request->isAjax() == true) {
            $month = $this->request->get('month');
            $username = $this->request->get('username', "string");
            $year = $this->request->get('year');
            $Attendances = new Attendances();
            $result = $Attendances->searchAttList($year, $month, $username);
            $this->view->disable();
            echo json_encode($result);
        }
    }

}
