<?php

namespace workManagiment\Notification\Controllers;
use workManagiment\Core\Models\Db\CoreMember;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/css/style.css');
        
    }

    
    public function indexAction(){
    }
    
//    /**
//     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
//     * get detail of the notification
//     */
//    public function detailAction() {
//    $id= $this->request->get('data');
//    $data= (explode(",",$id));
//    $NotiDetail=new \workManagiment\Core\Models\Db\CoreMember();
//    $noti=$NotiDetail->getdetail($data);
//    $this->view->disable();
//    echo json_encode($noti);
//    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Show All Notification in one page
     */
    public function viewallAction(){
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
       $update=new \workManagiment\Notification\Models\NotificationRelMember();
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
        $code=$this->session->permission_code;
        $Admin=new CoreMember();
        $id = $this->session->user['member_id'];
        if($code=="ADMIN"){
            $noti=$Admin->GetAdminNoti($id);}
        else{
            
            $noti=$Admin->GetUserNoti($id);
        }
        $this->view->setVar("noti",$noti);
        $type="aa";
        $this->view->setVar("type",$type);
        $noti_id= $this->request->get('id');
        $module_name= $this->request->get('mname');
        $Noti_detail=new \workManagiment\Notification\Models\Notification();
        $Detail_result=$Noti_detail->GetNotiInfo($module_name, $noti_id);
        $this->view->setVar("module_name",$module_name);
        $this->view->setVar("result",$Detail_result);
    }
    
    public function noticalendarAction(){
        
        $id=$this->request->getPost('id');
        $Noti=new \workManagiment\Notification\Models\Notification();
        if($this->session->permission_code=='ADMIN'){
        $Noti->calendarnotification($id);}
        else{
            $member_id=$this->session->user['member_id'];
            $Noti->usercalendarnotification($id,$member_id);
        }
    }
    
}

