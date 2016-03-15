<?php

namespace salts\Attendancelist\Controllers;

use salts\Core\Models\Db;
use salts\Attendancelist\Models\Attendances;
 
 
class SearchController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
         $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
          $this->view->permission = $this->permission;
    }

    public function indexAction() {
        
    }

    /**
     * Search attendance list
     * 
     */
    public function attsearchAction() {
           if ($this->permission == 1) {
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
         else {
             echo 'Page Not Found';
         }
    }

}
