<?php


namespace workManagiment\Setting\Controllers;
use workManagiment\Core\Models\Db;
class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        //$this->assets->addJs('common/js/btn.js');
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/setting/js/index.js');

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
        $updatedata['username']=$this->request->getPost('username');
        $updatedata['password']=$this->request->getPost('password');
        $updatedata['dept']=$this->request->getPost('dept');
        $updatedata['position']=$this->request->getPost('position');
        $updatedata['phno']=$this->request->getPost('phno');
        $updatedata['add']=$this->request->getPost('add');
        $updatedata['email']=$this->request->getPost('email');
        $updatedata['temp_pass']=$this->request->getPost('temp_password');
        $id=$this->session->user['member_id'];
        if($_FILES["fileToUpload"]["name"]==0){
          $updatedata['file']=$this->request->getPost('temp_file');
         
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
