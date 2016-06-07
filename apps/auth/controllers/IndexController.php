<?php

namespace salts\Auth\Controllers;

use salts\Auth\Models; 
use Phalcon\Filter;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/btn.js');   
         $this->assets->addJs('http://www.geoplugin.net/javascript.gp');   
    }

    /**  Index Action @param type $mode */
    public function indexAction($mode = NULL) {
        
        $localhost = ($this->request->getServer('HTTP_HOST'));
        $id_auth_filter = $this->session->auth;
        if (isset($id_auth_filter) != null) {
            $this->response->redirect('dashboard/index');
        } elseif (isset($id_auth_filter) == null) {
            if (isset($_SESSION['startTime']) != null) {
                $this->view->pick('salts/auth/index/failer');
                $page = "http://" . $localhost . "/salts/auth/index/failerUser";
                $sec = "1";
                header("Refresh: $sec; url=$page");
            } elseif (isset($_SESSION['startTime']) == null) {
                $mode = $this->request->get('mode');
                $this->view->errorMsg = '';
                $this->view->errorMsgForgot = '';
                $this->view->mode = $mode;
            }
        }
    }
  public function location_sessionAction() {
        $add = $this->request->get('location');
         $this->session->set('location', array(
            'location' => $add,
            'offset' => $offset
        ));
    }
    /**  When user failed login @param type $mode   */
    public function failerAction($mode = 1) {
        /*  User failerAction  @author Yan Lin Pai <wizardrider@gmail.com> */
        $this->view->errorMsg = 'company id or user name or password wrong';
        $this->view->errorMsgForgot = 'I forgot my password ?';
        if (!isset($_SESSION["attempts"]))
            $_SESSION["attempts"] = 0;
     
        if (4 > $_SESSION["attempts"]) {
        
                if ($this->session) {
                    
                $member_name = $this->session->tokenpush;
                $ChackUser = new Models\CoreMember();
                $chack_user2 = $ChackUser::findByMemberLoginName($member_name);
                $member_id = $this->request->getPost('member_login_name');
                
                if (0 != count($chack_user2)) {
                    $member_name = $this->session->tokenpush;
                    $core_fai_obj = Models\CoreMember::findFirstByMemberLoginName($member_name);
                    $core_fai_timeflag = $core_fai_obj->timeflag;
                    $timestamp = (date("Y-m-d H:i:s"));
                    if ($core_fai_timeflag >= $timestamp) {

                        $this->view->errorMsg = "You've Login To Next. 30 Minutes";
                        $this->view->pick('index/index');
                  
                        // Login To Next. 30 Minutes
                    } elseif ($core_fai_timeflag <= $timestamp) {
                        $_SESSION["attempts"] = $_SESSION["attempts"] + 1;
                        $this->view->errorMsg = "company id or user name or password wrong";
                        $this->view->pick('index/index');
                    }
                } elseif (0 == count($chack_user2)) {
                    $_SESSION["attempts"] = $_SESSION["attempts"] + 1;
                    $this->view->errorMsg = 'company id or user name or password wrong';
                    $this->view->pick('index/index');
                  }
              }
           
        } else  {
            
            $member_name = $this->session->tokenpush;
            $ChackUser = new Models\CoreMember();
            $chack_user = $ChackUser::findByMemberLoginName($member_name);

            if (0 == count($chack_user)) {
                $timestamp = (date("Y-m-d H:i:s"));
                $date = strtotime($timestamp);
                
                if (isset($_SESSION['startTime']) == null && count($chack_user) == 0) {

                    $_SESSION['startTime'] = date("Y-m-d H:i:s", strtotime("+30 minutes", $date));
                    $startTime = $_SESSION['startTime'];
                    $nowtime = (date("Y-m-d H:i:s"));
                    $_SESSION['expire'] = $_SESSION['startTime'];
                    $rout_time = $nowtime - $_SESSION['expire'];
                    $localhost = ($this->request->getServer('HTTP_HOST'));
                    $page = "http://" . $localhost . "/salts/auth/index/failerUser";
                    $sec = "1";
                    header("Refresh: $sec; url=$page");
                    if ($nowtime > $_SESSION['expire']) {
                        session_destroy();
                        echo "Your session has expired ! ";
                    }
                } else if (isset($_SESSION['startTime']) != null && count($chack_user) == 0) {
                    $nowtime = (date("Y-m-d H:i:s"));
                    $_SESSION['expire'] = $_SESSION['startTime']; // ending a session in 30
                    // checking the time now when home page starts
                    $rout_time = $nowtime - $_SESSION['expire'];
                    
                    $localhost = ($this->request->getServer('HTTP_HOST'));
                    $page = "http://" . $localhost . "/salts/auth/index/failerUser";
                    $sec = "1";
                    header("Refresh: $sec; url=$page");
                    if ($nowtime > $_SESSION['expire']) {
                        session_destroy();
                    }
                }
            }
            // User Not Has
            elseif (0 != count($chack_user)) {
                $member_name = $this->session->tokenpush;
                $Chack = new Models\CoreMember();
                $timestamp = (date("Y-m-d H:i:s"));
                $date = strtotime($timestamp);
                $formtdate = date("Y-m-d H:i:s", strtotime("+30 minutes", $date));
                $member_name_find = Models\CoreMember::findFirst("member_login_name = '$member_name'");
                $member_id = $member_name_find->member_id;
                $member_name_find->timeflag = $formtdate;
                $member_name_find->update();
                $this->view->errorMsg = 'Your Account Has 30 MIN Block';
                $this->view->pick('index/index');
                session_destroy();
            }
        }
        
    }

    public function failerUserAction() {

        //Count For Not User Has
        $member_name = $this->session->tokenpush;
        $ChackUser = new Models\CoreMember();
        $chack_user = $ChackUser::findByMemberLoginName($member_name);
        if (0 == count($chack_user)) {
            $timestamp = (date("Y-m-d H:i:s"));
            $date = strtotime($timestamp);
            if (isset($_SESSION['startTime']) == null && count($chack_user) == 0) {
                $_SESSION['startTime'] = date("Y-m-d H:i:s", strtotime("+30 minutes", $date));
                $startTime = $_SESSION['startTime'];
                $nowtime = (date("Y-m-d H:i:s"));
                $_SESSION['expire'] = $_SESSION['startTime'];
                $rout_time = $nowtime - $_SESSION['expire'];
                $localhost = ($this->request->getServer('HTTP_HOST'));
                $page = "http://" . $localhost . "/salts/auth/index/failerUser";
                $sec = "10";
                header("Refresh: $sec; url=$page");
                if ($nowtime > $_SESSION['expire']) {
                    session_destroy();
                    echo "Your Can Login To System ! ";
                }
            } else if (isset($_SESSION['startTime']) != null && count($chack_user) == 0) {
                $nowtime = (date("Y-m-d H:i:s"));
                $_SESSION['expire'] = $_SESSION['startTime']; // ending a session in 30
                // checking the time now when home page starts
                $rout_time = $nowtime - $_SESSION['expire'];
                $localhost = ($this->request->getServer('HTTP_HOST'));
                $page = "http://" . $localhost . "/salts/auth/index/failerUser";
                $sec = "10";
                header("Refresh: $sec; url=$page");
                if ($nowtime > $_SESSION['expire']) {
                    session_destroy();
                    echo "Your Can Login To System ! ";
                }
            }
        }
    }

    /**  When user failed  email  go  @param type $mode  */
    public function failersuperuserAction() {
        $this->view->errorMsg = 'user name or password wrong';
        $this->view->errorMsgForgot = '';
        $this->view->mode = 1;
        $this->view->pick('index/index');
    }

    public function saltsForGetAction() {

        // $Core = new CoreMember();
        $login = $this->request->getPost('SaltsForGetInput');
        $user = Users::findFirstByLogin($login);
        if ($user) {
            $this->view->disable();
            $this->response->redirect('setting/index/index');
        }
    }

    public function forGotPasswordAction() {
        
    }

    public function sendMailAction() {

        $filter = new Filter();
        $member_mail = $filter->sanitize($this->request->get('email'), "string");
        $Admin = new \salts\Auth\Models\CoreMember();
        $result = $Admin::findFirst("member_mail = '" . $member_mail . "' AND deleted_flag = 0 ");
        if ($result) {
            $this->view->setVar("Result", $result);
        } else {
            echo 'Error';
        }
    }

    public function newPasswordAction() {
        $member_mail = $this->request->get('email');
        $this->view->setvar("member_mail", $member_mail);
    }

    public function checkMailAction() {
        $filter = new Filter();
        $member_mail = $filter->sanitize($this->request->get('email'), "string");
        $Admin = new \salts\Auth\Models\CoreMember();
        $result = $Admin::findFirst("member_mail = '" . $member_mail . "' AND deleted_flag = 0 ");
        if ($result) {
            $msg = "success";
        } else {
            $msg = "fail";
        }
        $this->view->disable();
        echo json_encode($msg);
    }

    public function checkCodeAction() {
        $filter = new Filter();
        $code = $this->request->get('code');
        $email = $filter->sanitize($this->request->get('email'), "string");
        $FindCode = new \salts\Auth\Models\CoreForgotPassword();
        $result = $FindCode::find(array("check_mail = '$email'", "order" => "curdate DESC", "limit" => 1));
        foreach ($result as $value) {
            $finded_token = $value->token;
        }
        if ($code == $finded_token) {
            $msg = "success";
        } else {
            $msg = "fail";
        }
        $this->view->disable();
        echo json_encode($msg);
    }

    public function resetPasswordAction() {
        $filter = new Filter();
        $member_mail = $filter->sanitize($this->request->get('email'), 'string');
        $Admin = new \salts\Auth\Models\CoreMember();
        $result = $Admin::find(array("member_mail = '$member_mail'", "deleted_flag = 0"));
        $data = [];
        foreach ($result as $value) {
            $data[] = $value->member_profile;
            $data[] = $value->member_mail;
            $data[] = $value->member_login_name;
        }
        $this->view->setVar("Result", $data);
    }

    public function changePasswordAction() {
        $filter = new Filter();
        $newpass = $this->request->get('fnp');
        $member_mail = $filter->sanitize($this->request->get('email'), 'string');
        $Up = new \salts\Auth\Models\CoreMember();
        $result = $Up::find(array("member_mail = '$member_mail'", "deleted_flag = 0"));
        foreach ($result as $value) {
            $value->member_password = sha1($newpass);
            $value->update();
        }
        if ($value) {
            $msg = "success";
        } else {
            $msg = "fail";
        }
        $this->view->disable();
        echo json_encode($msg);
    }

    public function sendToMailAction() {
        $filter = new Filter();
        $getemail = $filter->sanitize($this->request->get('email'), 'string');
        $Insert = new \salts\Auth\Models\CoreForgotPassword();
        $token = uniqid(bin2hex(mcrypt_create_iv(1, MCRYPT_DEV_RANDOM)));
        $Insert->check_mail = $getemail;
        $Insert->token = $token;
        $Insert->save();
        $Find = $Insert::find(array("check_mail = '$getemail'", "order" => "curdate DESC", "limit" => 1));
        $finded_token = '';
        foreach ($Find as $value) {
            $finded_token = $filter->sanitize($value->token, "string");
        }
        $to = $getemail;
        $subject = 'The subject';
        $message = $finded_token;
        $headers = 'From: sawzinminmin@gmail.com' . "\r\n" . 'Reply-To: sawzinminmin@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $msg = "success";
        } else {
            $msg = "fail";
        }
        $this->view->disable();
        echo json_encode($msg);
    }

}
