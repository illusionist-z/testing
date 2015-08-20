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
        $this->assets->addJs('apps/attendancelist/js/index-monthlylist.js');
        $this->assets->addCss('common/css/pagination.css');        
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('common/js/paging.js');        
        $this->assets->addJs('apps/attendancelist/js/index.js');                     
    }

   /**
    * show today attendance list
    */    
    public function todaylistAction() {
        $name = $this->request->get('namelist');
        $offset= $this->session->location['offset'];          
        //get user name
        //$userlist= new \workManagiment\Attendancelist\Models\CoreMember();
        $UserList=new Db\CoreMember();
        $Username = $UserList::getinstance()->getusername();        
        $AttList = new \workManagiment\Attendancelist\Models\Attendances(); 
        $ResultAttlist = $AttList->gettodaylist($name);        
        $this->view->attlist=$ResultAttlist;
        $this->view->offset= $offset;
        $this->view->uname = $Username;
    }
    
    /**
     * Show monthly attendance list
     */
    public function monthlylistAction() {
       
        $offset= $this->session->location['offset'];
        $UserList=new Db\CoreMember();
        $UserName = $UserList::getinstance()->getusername();
        $month = $this->config->month;                
        $Attendances = new \workManagiment\Attendancelist\Models\Attendances();
        $monthlylist = $Attendances->showattlist();
        $this->view->monthlylist = $monthlylist;
        $this->view->setVar("Month", $month);        
        $this->view->setVar("Getname", $UserName);                
        $this->view->offset=$offset;
    }    
}

