<?php

namespace workManagiment\Attendancelist\Controllers;

use workManagiment\Core\Models\Db;
class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->assets->addJs('common/js/export.js');
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');
        
        $user = $this->session->get('user');
        
        $this->view->user = $user;
        
    }
    
    public function todaylistAction() {
        $offset= $this->session->location['offset'];
        $name = $this->request->get('namelist');
        $attlist = new \workManagiment\Attendancelist\Models\Attendances();
        
        //get user attendance list for today
        $result_attlist = $attlist->gettodaylist($name);                
        //get user name
        //$userlist= new \workManagiment\Attendancelist\Models\CoreMember();
        $userlist=new Db\CoreMember();
        $username = $userlist::getinstance()->getusername();
        
        $this->view->attlist = $result_attlist;
        $this->view->offset=$offset;
        $this->view->uname = $username;
    }
    
    //show monthly list
    public function monthlylistAction() {
       
        $offset= $this->session->location['offset'];
        $userlist=new Db\CoreMember();
        $user_name = $userlist::getinstance()->getusername();

        require '../apps/attendancelist/config/config.php';
        $month = $config->month;

        $year = $this->request->get('year');
        
        $mth = $this->request->get('month');
        $username = $this->request->get('username');
        
        $attendances = new \workManagiment\Attendancelist\Models\Attendances();
        $result = $attendances->showmonthlylist($year, $mth, $username);
        
        $this->view->setVar("Month", $month);
        $this->view->setVar("showlist", $result);
        $this->view->setVar("Getname", $user_name);
        
        $this->view->setVar("Year", $year);
        $this->view->setVar("Mth", $mth);
        $this->view->setVar("Name", $username);
        $this->view->offset=$offset;
    }
    
    

}

