<?php

namespace workManagiment\Attendancelist\Controllers;

class UserController extends ControllerBase
{

    

    public function initialize() {
        parent::initialize();
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('apps/attendancelist/js/index.js');
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
        //$this->assets->addCss('common/css/home/home.css');
        
        $user = $this->session->get('user');
        
        $this->view->user = $user;
        
    }
    /**
     * getting user attendance list by user id
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function attendancelistAction(){
        
        if(isset($this->session->tzoffset)){
           $offset= $this->session->tzoffset['offset'];
           $timezone=$this->session->tzoffset['timezone'];
        }else{
        $offset= $this->session->location['offset'];
        $timezone=$this->session->location['timezone'];
        }
       
        $month = $this->request->get('month');
        $id= $this->session->user['member_id'];
        $Att_list = new \workManagiment\Attendancelist\Models\Attendances();
        $result_attlist = $Att_list->getattlist($id,$month);      
         $this->view->attlist = $result_attlist;
         $this->view->offset=$offset;
         $this->view->timezone=$timezone;
       
    }
    
   

}

