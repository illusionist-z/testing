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
        $this->assets->addJs('apps/attendancelist/js/index.js');        
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
        $User_list=new Db\CoreMember();
        $username = $User_list::getinstance()->getusername();        
        //$this->view->attlist = $result_attlist;
        $this->view->offset=$offset;
        $this->view->uname = $username;
    }
    public function showtodaylistAction(){
         $name = $this->request->get('namelist');
        $Att_list = new \workManagiment\Attendancelist\Models\Attendances();        
        //get user attendance list for today
        $result_attlist = $Att_list->gettodaylist($name);      
        $this->view->disable();
        echo json_encode($result_attlist);
    }
    /**
     * Show monthly attendance list
     */
    public function monthlylistAction() {
       
        $offset= $this->session->location['offset'];
        $User_list=new Db\CoreMember();
        $user_name = $User_list::getinstance()->getusername();
        $month = $this->config->month;                
        $this->view->setVar("Month", $month);        
        $this->view->setVar("Getname", $user_name);                
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

