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
        $AttList = new \workManagiment\Attendancelist\Models\Attendances();
        $ResultAttlist = $AttList->getattlist($id,$month);                      
         $this->view->attlist = $ResultAttlist;
         $this->view->offset=$offset;
         $this->view->timezone=$timezone;       
    }      
}

