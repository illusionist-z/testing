<?php

namespace workManagiment\Attendancelist\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
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
        $userlist= new \workManagiment\Attendancelist\Models\CoreMember();
        $username = $userlist->getusername();

        $this->view->attlist = $result_attlist;
        $this->view->offset=$offset;
        $this->view->uname = $username;
    }
    
    public function userAction(){
        
    }

}

