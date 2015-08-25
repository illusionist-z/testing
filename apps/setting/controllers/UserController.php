<?php


namespace workManagiment\Setting\Controllers;
use workManagiment\Core\Models\Db;
class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/setting/js/user-changeprofile.js');

    }

    public function indexAction() {
         
    }
    public function usersettingAction() {
     $user= new Db\CoreMember;
     $id=$this->session->user['member_id'];
     $user= $user->UserDetail($id);
     $this->view->userdetail=$user;
    }
    /**
     * change profile 
     * user setting
     * @author Su Zin Kyaw
     */
    public function changeprofileAction(){
        if ($this->request->isPost()) {
            
        $updatedata=array();
        $updatedata=$this->request->getPost('member');
        $timezone=$this->request->getPost('timezone');
        if($timezone!="0"){
        $arr=(explode(" ",$timezone));
        $sessiontz=$arr['1'];
        //convert +/- Hours to Seconds
        sscanf($sessiontz, "%d:%d:%d", $hours, $minutes, $seconds);
        $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        $s=($time_seconds*-1);
        
        $this->session->set('tzoffset', array(
            'offset'=>$s,
            'timezone'=>$arr['2']
        ));
        }
        $id=$this->session->user['member_id'];
        if($_FILES["fileToUpload"]["name"]==NULL){
          $updatedata['file']=$updatedata['temp_file'];
        }
        else{
            $updatedata['file']=$_FILES["fileToUpload"]["name"];
        }
        $User=new Db\CoreMember;
        $User->updatedata($updatedata,$id);
        }
         $this->response->redirect('setting/user/usersetting');

    }
    
    
   
 
        
     
        
   
  
}
