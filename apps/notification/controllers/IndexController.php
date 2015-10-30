<?php

namespace workManagiment\Notification\Controllers;
use workManagiment\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        
    }

    
    public function indexAction(){
        
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Show All Notification in one page
     */
    public function viewallAction(){
        $this->setCommonJsAndCss();

        $type=viewall;
        $code=$this->session->permission_code;
        $Admin=new CoreMember();
        $id = $this->session->user['member_id'];
        if($code=="ADMIN"){
            $noti=$Admin->GetAdminNoti($id);}
        else{
            $id = $this->session->user['member_id'];
            $noti=$Admin->GetUserNoti($id);
        }
        $this->view->setVar("noti",$noti);
        $this->view->setVar("type",$type);
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * when user seen noti and click ok update data
     */
    public function update_notiAction(){
       $noti_id=$this->request->getPost('noti_id');
       $update=new \workManagiment\Notification\Models\CoreNotificationRelMember();
       $update->updateNoti($noti_id);
    }
    
    public function notificationAction(){
        $code=$this->session->permission_code;
           $Admin=new CoreMember();
           $id = $this->session->user['member_id'];
        if($code=="ADMIN"){
   
        $noti=$Admin->GetAdminNoti($id);}
        else{
            $id = $this->session->user['member_id'];
             $noti=$Admin->GetUserNoti($id);
        }
        $type='noti';
        //print_r($noti);exit;
        $this->view->setVar("noti",$noti);
        $this->view->setVar("type",$type);
    }
    
    public function detailAction(){
        $this->setCommonJsAndCss();
        $code=$this->session->permission_code;
        $Admin=new CoreMember();
        $id = $this->session->user['member_id'];
        if($code=="ADMIN"){
            $noti=$Admin->GetAdminNoti($id);}
        else{
            
            $noti=$Admin->GetUserNoti($id);
        }
        $this->view->setVar("noti",$noti);
        $type="detail";
        $this->view->setVar("type",$type);
        $noti_id= $this->request->get('id');
        $module_name= $this->request->get('mname');
        $Noti_detail=new \workManagiment\Notification\Models\CoreNotification();
        $Detail_result=$Noti_detail->GetNotiInfo($module_name, $noti_id);
        $this->view->setVar("module_name",$module_name);
        $this->view->setVar("result",$Detail_result);
    }
    
   /**
     * notification for calendar
     * when someone add event on calendar
     */
    public function noticalendarAction(){
        
        $id=$this->request->get('id');
        $Noti=new \workManagiment\Notification\Models\CoreNotification();
        if($this->session->permission_code=='ADMIN'){
        $Noti->calendarnotification($id);}
        else{
            $member_id=$this->session->user['member_id'];
            $Noti->usercalendarnotification($id,$member_id);
        }
        $this->response->redirect("calendar/index");
    }
    
     public function notiattendancesAction(){
        
        $id=$this->request->get('id');
        $Noti=new \workManagiment\Notification\Models\CoreNotification();
        $Noti->attnotification($id);
        $this->response->redirect("attendancelist/index/todaylist");

      
    }
    
}

