<?php

namespace workManagiment\Auth\Controllers;
use workManagiment\Core\Models\Db\CoreMember;
use workManagiment\Auth\Models;
use workManagiment\Core\Models\Db;

class IndexController extends ControllerBase {

        public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        }

        public function indexAction($mode = NULL) {
        $this->view->errorMsg = '';
        }

    /**
     * When user failed login
     * @param type $mode
     */
        public function failerAction($mode = 1) {
        $this->view->errorMsg = 'IDもしくはパスワードが正しくありません。';
        $this->view->pick('index/index');
        }
        /**
     * When user failed  email  go 
     * @param type $mode
     */
        public function faileremailAction($mode = 1) {
        $this->view->errorMsg = 'IDもしくはパスワードが正しくありません。';
      //  $this->view->pick('index/forgotpassword');
    }
    
    public function forgotpasswordAction() {
         $this->assets->addJs('apps/auth/js/forgot.js');      
       
    }
    public function resetyourpasswordAction() {
       // echo 'aa';
           
        //echo $member_mail;exit;
//        $UserList = new Db\CoreMember();
//        $Username = $UserList::getinstance()->getusername();
//       //print_r($member_mail);exit;
//      // echo $member_mail;exit;
//         $ModelAuth = new Models\Auth();
//        $ModelAuth->findemail($member_mail);
    }
      public function sendmailAction() {        
         $member_mail = $this->request->getPost('member_mail');   
         $Admin=new Db\CoreMember;
         
         $result = $Admin->findemail($member_mail);
         
         $token = uniqid(bin2hex(mcrypt_create_iv(10, MCRYPT_DEV_RANDOM)));
         
         $insert  = $Admin->insertemailandtoken($member_mail,$token);
         
        if($result){
          //print_r($result);exit;
            $this->view->setVar("Result", $result);
           // sendmail($result);
//            $token = uniqid(bin2hex(mcrypt_create_iv(45, MCRYPT_DEV_RANDOM)));
//            print_r($token);exit;
             //$this->view->email = $result;       
             //$this->response->redirect('auth/index/resetyourpassword');
        }
       else{
           echo 'Error';
          //  print_r($user);exit;
         //  $this->response->redirect('auth/index/faileremail');
       }
          
    }
    public function newpasswordAction() {     
        $member_mail = $this->request->getPost('member_mail'); 
         $newpassword = $this->request->getPost('newpassword');   
         $comfirmpassword = $this->request->getPost('comfirmpassword');  
         
         $Admin=new Db\CoreMember;
         $result = $Admin->findemail($member_mail);
         
             $this->view->setVar("Result", $result);
         
         
         if($newpassword == $comfirmpassword){
             
              $result = $Admin->updatepassword($member_mail,$newpassword);
         }
         else{
             
         }
         
          
    }
     public function checkmailAction() {
         
        $this->assets->addJs('apps/auth/js/forgot.js');      
          $member_mail = $this->request->get('email');   
         $Admin=new Db\CoreMember;
         $result = $Admin->findemail($member_mail);
        if($result){
            $msg="success";
        }
       else{
           $msg="fail";
       }
         $this->view->disable();
        echo json_encode($msg);
    }
    
    public function resetpasswordAction(){
         $member_mail = $this->request->get('email');   
         $Admin=new Db\CoreMember;
         $result = $Admin->findemail($member_mail);
         $this->view->setVar("Result", $result);

    }
}
