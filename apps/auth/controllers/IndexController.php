<?php

namespace salts\Auth\Controllers;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;

class IndexController extends ControllerBase {

        public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
            $this->assets->addJs('apps/auth/js/forgot.js');      
        }

        public function indexAction($mode = NULL) {
            
       
        $localhost = ($this->request->getServer('HTTP_HOST'));
 
        if (isset($_SESSION['startTime']) != null) {
            $this->view->pick('salts/auth/index/failer');
            $page = "http://".$localhost."/salts/auth/index/failer";
            $sec = "1";
            header("Refresh: $sec; url=$page");
        } elseif (isset($_SESSION['startTime']) == null) {

            $mode = $this->request->get('mode');
            $this->view->errorMsg = '';
            $this->view->mode = $mode;
        }
    }

    /**
     * When user failed login
     * @param type $mode
     */
    public function failerAction($mode = 1) {
        /*
        * User failerAction 
        * @author Yan Lin Pai <wizardrider@gmail.com>
        *     
        */
        date_default_timezone_set('Asia/Rangoon');
        if (!isset($_SESSION["attempts"]))
            $_SESSION["attempts"] = 0;

        if ($_SESSION["attempts"] < 4) {

            if ($this->session) {
                                  
                $member_name = $this->session->tokenpush;
                $chack_user2 = new CoreMember();
                $chack_user2 = $chack_user2::findByMemberLoginName($member_name);
                $member_id = $this->request->getPost('member_login_name');

                if (count($chack_user2) != 0) {

                    $member_name = $this->session->tokenpush;
                    $core_fai = new CoreMember();
                    $core_fai = CoreMember::findFirstByMemberLoginName($member_name);
                    $core_fai = $core_fai->timeflag;
                    $timestamp = (date("Y-m-d H:i:s"));

                    if ($core_fai >= $timestamp) {

                        $this->view->errorMsg = "You've Login To Next. 30 Minutes";
                        $this->view->pick('index/index');
                        session_destroy();
                        // Login To Next. 30 Minutes
                    } elseif ($core_fai <= $timestamp) {
                        
                         $_SESSION["attempts"] = $_SESSION["attempts"] + 1;
                        $this->view->errorMsg = "company id or user name or password wrong";
                        $this->view->pick('index/index');
                    }
                } elseif (count($chack_user2) == 0) {

                    $_SESSION["attempts"] = $_SESSION["attempts"] + 1;
                    $this->view->errorMsg = 'company id or user name or password wrong';
                    $this->view->pick('index/index');
                }
                // echo "You failed to log-in, try again";
            }
        } else {
            $member_name = $this->session->tokenpush;
            $chack_user = new CoreMember();
            $chack_user = $chack_user::findByMemberLoginName($member_name);


            if (count($chack_user) == 0) {
                $timestamp = (date("Y-m-d H:i:s"));
                $date = strtotime($timestamp);

                if (isset($_SESSION['startTime']) == null && count($chack_user) == 0) {

                    $_SESSION['startTime'] = date("Y-m-d H:i:s", strtotime("+30 minutes", $date));
                    $startTime = $_SESSION['startTime'];
                    $nowtime = (date("Y-m-d H:i:s"));

                    $_SESSION['expire'] = $_SESSION['startTime'];
                    $rout_time = $nowtime - $_SESSION['expire'];
                     $localhost = ($this->request->getServer('HTTP_HOST'));
                     
                    $page = "http://".$localhost."/salts/auth/index/faileruser";
                    $sec = "1";
                    header("Refresh: $sec; url=$page");
                    if ($nowtime > $_SESSION['expire']) {
                        session_destroy();
                        echo "Your session has expired ! ";
                        //$this->response->redirect('auth');    
                    }
                } else if (isset($_SESSION['startTime']) != null && count($chack_user) == 0) {
                    $nowtime = (date("Y-m-d H:i:s"));
                    $_SESSION['expire'] = $_SESSION['startTime']; // ending a session in 30
                    // checking the time now when home page starts
                    $rout_time = $nowtime - $_SESSION['expire'];
                     $localhost = ($this->request->getServer('HTTP_HOST'));    
                     
                    $page = "http://".$localhost."/salts/auth/index/faileruser";
                    $sec = "1";
                    header("Refresh: $sec; url=$page");
                    if ($nowtime > $_SESSION['expire']) {
                        session_destroy();
                        echo " ";
                    }
                }
            }
            // User Not Has
            elseif (count($chack_user) != 0) {
                $member_name = $this->session->tokenpush;
                $chack = new CoreMember();
                date_default_timezone_set('Asia/Rangoon');
                $timestamp = (date("Y-m-d H:i:s"));
                $date = strtotime($timestamp);
                $formtdate = date("Y-m-d H:i:s", strtotime("+30 minutes", $date));
                $insert = $chack->timeflag($member_name, $formtdate);
                $this->view->errorMsg = 'Your Account Has 30 MIN Block';
                $this->view->pick('index/index');
                session_destroy();
            }
        }
    }

    
    
    public function faileruserAction() {
          
        //Count For Not User Has
        date_default_timezone_set('Asia/Rangoon');
        $member_name = $this->session->tokenpush;
        $chack_user = new CoreMember();
        $chack_user = $chack_user::findByMemberLoginName($member_name);
        if (count($chack_user) == 0) {
            $timestamp = (date("Y-m-d H:i:s"));
            $date = strtotime($timestamp);

            if (isset($_SESSION['startTime']) == null && count($chack_user) == 0) {

                $_SESSION['startTime'] = date("Y-m-d H:i:s", strtotime("+30 minutes", $date));
                $startTime = $_SESSION['startTime'];
                $nowtime = (date("Y-m-d H:i:s"));

                $_SESSION['expire'] = $_SESSION['startTime'];

                $rout_time = $nowtime - $_SESSION['expire'];
                  $localhost = ($this->request->getServer('HTTP_HOST'));   
                //  $this->view->pick('salts/auth/index/faileruser');
                $page = "http://".$localhost."/salts/auth/index/faileruser";
                $sec = "10";
                header("Refresh: $sec; url=$page");
                if ($nowtime > $_SESSION['expire']) {
                    session_destroy();
                    echo "Your session has expired ! ";
                    //$this->response->redirect('auth');    
                }
            } else if (isset($_SESSION['startTime']) != null && count($chack_user) == 0) {
                $nowtime = (date("Y-m-d H:i:s"));
                $_SESSION['expire'] = $_SESSION['startTime']; // ending a session in 30
                // checking the time now when home page starts
                $rout_time = $nowtime - $_SESSION['expire'];
                $localhost = ($this->request->getServer('HTTP_HOST'));      
                //$this->view->pick('salts/auth/index/failer');
                $page = "http://".$localhost."/salts/auth/index/faileruser";
                $sec = "10";
                header("Refresh: $sec; url=$page");
                if ($nowtime > $_SESSION['expire']) {
                    session_destroy();
                }
            }
        }
    }
        /**
     * When user failed  email  go 
     * @param type $mode
     */
    public function failersuperuserAction() {
        $this->view->errorMsg = 'user name or password wrong';
        //$this->view->mode=1;
        $this->view->pick('index/index');
    }
    
    public function forgotpasswordAction() {
       //  $this->assets->addJs('apps/auth/js/forgot.js');      
       
    }
  public function SaltsForGetAction()
    {
        $core = new CoreMember();
        $login = $this->request->getPost('SaltsForGetInput');
        $user = Users::findFirstByLogin($login);
        if ($user) {
               $this->view->disable();
              $this->response->redirect('setting/index/index');
         }
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
         $member_mail = $this->request->get('email');
         $Admin=new Db\CoreMember;
         
         $result = $Admin->findemail($member_mail);
         
         
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
         //$this->assets->addJs('apps/auth/js/forgot.js');   
//        $newpass = $this->request->get('fnp'); 
   $member_mail = $this->request->get('email');     
   $this->view->setvar("member_mail",$member_mail);
//     
//         $Admin=new Db\CoreMember;
//         
//          $update = $Admin->updatenewpassword($member_mail,$newpass);
//                if($update){
//                    //print_r($update);
//                   $msg="success";
//               }
//              else{
//                  $msg="fail";
//              }
//        // $this->view->disable();
//        echo json_encode($msg);                                                                                                                                                                                               
    }
     public function checkmailAction() {
          $member_mail = $this->request->get('email');   
         $Admin = new CoreMember();
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
    
     public function checkcodeAction() {  
         $code = $this->request->get('code');    
         $email = $this->request->get('email');  
         $Admin=new Db\CoreMember;
         $result = $Admin->findcode($code,$email);
//        if($result){
//            $msg="success";
//        }
//       else{
//           $msg="fail";
//       }
         $this->view->disable();
        echo json_encode($result);
    }
    // for send email 
       public function sendemailAction() {  
                $email = $this->request->get('email');
                $Admin=new Db\CoreMember;
                $result = $Admin->findsecuritycode($email);
                if($result){
                        $to      = $email;
                        $subject = 'The subject';
                        $message = $result;
                        $headers = 'From: sawzinminmin@gmail.com' . "\r\n" .
                            'Reply-To: sawzinminmin@gmail.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                        if(mail($to, $subject, $message, $headers)){
                            echo $to ." : " .$subject." : ".$message." : ".$headers;
                            echo "Mail Sent";
                        }else{
                            echo "Email sending failed";
                        }
                }
                


    }
//    //for change password 
//    public function changepasswordAction() {
//         $newpass = $this->request->get('newpass');    
//         $email = $this->request->get('email');  
//         $Admin=new Db\CoreMember;
//         $result = $Admin->updatenewpassword($newpass,$email);
//        if($result){
//            $msg="success";
//        }
//       else{
//           $msg="fail";
//       }
//         $this->view->disable();
//        echo json_encode($msg);
//    }
    public function resetpasswordAction(){
         $member_mail = $this->request->get('email');   
         $Admin=new Db\CoreMember;
         $result = $Admin->findemail($member_mail);
         $this->view->setVar("Result", $result);

    }
    
     public function changepasswordAction() {  
        $newpass = $this->request->get('fnp'); 
        $member_mail = $this->request->get('email');  
       // print_r($member_mail);
        //print_r($newpass);exit;
         $Admin=new Db\CoreMember;
         
          $update = $Admin->updatenewpassword($member_mail,$newpass);
                if($update){
                    //print_r($update);exit;
                   $msg="success";
               }
              else{
                  $msg="fail";
              }
         $this->view->disable();
        echo json_encode($msg);                                                                                                                                                                                               
    }
      public function sendtomailAction() {  
        $getemail = $this->request->get('email');
        $Admin=new Db\CoreMember;
        
         $token = uniqid(bin2hex(mcrypt_create_iv(1,MCRYPT_DEV_RANDOM)));         
         $Admin->insertemailandtoken($getemail,$token);
         
        $result = $Admin->checkyourmail($getemail);
       // print_r($result);exit;
                        $to      = $getemail;
                        $subject = 'The subject';
                        $message = $result;
                        $headers = 'From: sawzinminmin@gmail.com' . "\r\n" .
                            'Reply-To: sawzinminmin@gmail.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                        if(mail($to, $subject, $message, $headers)){
//                            echo $to ." : " .$subject." : ".$message." : ".$headers;
//                            echo "Mail Sent";
                            $msg = "success";
                        }else{
//                            echo "Email sending failed";
                            $msg = "fail";
                        }
                 $this->view->disable();
                echo json_encode($msg);      
    }
}
