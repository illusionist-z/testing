<?php

namespace workManagiment\Attendancelist\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Attendancelist\Models\Attendances;
class SearchController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
       
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/attendancelist/js/search-attsearch.js');
        $this->config = \Module_Config::getModuleConfig('leavedays');
    }

    
    public function indexAction(){
      
    }
    
    
    /**
     * Search attendance list
     * 
     */
    public function attsearchAction() {        
        $month = $this->request->getQuery('month');
        $username = $this->request->get('username');
        $year = $this->request->get('year');           
        $offset= $this->session->location['offset'];
        $Attendances=new Attendances();
        $result=$Attendances->search_attlist($year,$month,$username);
        $this->view->disable();
       
        echo json_encode($result);
    }
    
    
    

}

