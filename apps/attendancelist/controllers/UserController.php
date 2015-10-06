<?php

namespace workManagiment\Attendancelist\Controllers;
use workManagiment\Core\Models\Db;

class UserController extends ControllerBase
{

    

    public function initialize() {
        parent::initialize();
        parent::getmodulename();
        $this->assets->addJs('common/js/export.js');
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/attendancelist/js/user-attendancelist.js');        
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
        $User=new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti=$User->GetUserNoti($id);
        $this->view->setVar("noti",$noti);
        if(isset($this->session->tzoffset)){
           $offset= $this->session->tzoffset['offset'];
           $timezone=$this->session->tzoffset['timezone'];
           $this->view->timezone=$timezone;
        }else{
        $offset= $this->session->location['offset'];
        
        }
        $startdate = $this->request->get('startdate');       
        $enddate = $this->request->get('enddate');
       
       
        $AttList = new \workManagiment\Attendancelist\Models\Attendances();
        $ResultAttlist = $AttList->getattlist($id,$startdate,$enddate);                      
        $this->view->attlist = $ResultAttlist;
        $this->view->offset=$offset;              
    }
    
   

}

