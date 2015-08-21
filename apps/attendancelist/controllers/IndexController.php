<?php

namespace workManagiment\Attendancelist\Controllers;

use workManagiment\Core\Models\Db;
class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/attendancelist/js/index-showtodaylist.js');    
        $this->assets->addJs('apps/attendancelist/js/search-attsearch.js');
        $this->assets->addJs('apps/attendancelist/js/index-monthlylist.js');
        $this->assets->addCss('common/css/pagination.css');        
        $this->config = \Module_Config::getModuleConfig('leavedays');
    }

   /**
    * show today attendance list
    */    
    public function todaylistAction() {
        
         $offset= $this->session->location['offset'];          
        //get user name
        //$userlist= new \workManagiment\Attendancelist\Models\CoreMember();
        $UserList=new Db\CoreMember();
        $Username = $UserList::getinstance()->getusername();        
        //$this->view->attlist = $result_attlist;
        $this->view->offset=$offset;
        $this->view->uname = $Username;
    }
    public function showtodaylistAction(){
        $name = $this->request->get('namelist');
        $AttList = new \workManagiment\Attendancelist\Models\Attendances();        
        //get user attendance list for today
        $ResultAttlist = $AttList->gettodaylist($name);      
        $this->view->disable();
        echo json_encode($ResultAttlist);
    }
    /**
     * Show monthly attendance list
     */
    public function monthlylistAction() {
       
        $offset= $this->session->location['offset'];
        $UserList=new Db\CoreMember();
        $UserName = $UserList::getinstance()->getusername();
        $month = $this->config->month;                
        $this->view->setVar("Month", $month);        
        $this->view->setVar("Getname", $UserName);                
        $this->view->offset=$offset;
    }
    /**
     * show monthly attendance list by json
     */
    public function showmonthlylistAction(){
        $Attendances = new \workManagiment\Attendancelist\Models\Attendances();
        $result = $Attendances->showattlist();
        $this->view->disable();
        echo json_encode($result);        
    }    
}

