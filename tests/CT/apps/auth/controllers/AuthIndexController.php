<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexControllerTest
 *
 * @author Su Zin Kyaw <gnext.suzin@gmail.com>
 */ 
use salts\Auth\Models;
use Phalcon\Filter;
use salts\Auth\Controllers;

 
/**
 * Class UnitTest
 */
class AuthIndexController extends Controllers\IndexController {

    public $param = array();
    public $mailParam;
    public $pwd;

    public function setparam($param) {
        $this->param = $param;
    }

    public function setmailParam($mailParam) {
        $this->mailParam = $mailParam;
    }

    public function setpwd($pwd) {
        $this->pwd = $pwd;
    }

    public function failerAction($mode = 1) {

        /* User failerAction @author Yan Lin Pai <wizardrider@gmail.com> */
        $filter = new Filter();
        date_default_timezone_set('UTC');
         if (!isset($_SESSION["attempts"]))
            $_SESSION["attempts"] = 0;

        if (4 > $_SESSION["attempts"]) {
                    if ($this->session) {
                        $member_name = $this->param['member_login_name'];
                        $ChackUser = new Models\CoreMember();
                        $chack_user2 = $ChackUser::findByMemberLoginName($member_name);
                        $member_id = $this->request->getPost('member_login_name');
                if (0 == count($chack_user2)) {
                        $_SESSION["attempts"] = $_SESSION["attempts"] + 1;
                        return 'company id or user name or password wrong';
                }
            }
        }
    }

    public function failerUserAction() {
        //Count For Not User Has
        date_default_timezone_set('Asia/Rangoon');
        $member_name = $this->param['member_login_name'];
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
                    echo "Your session has expired ! ";
                }
            } else if (isset($_SESSION['startTime']) != null && count($chack_user) == 0) {

                $nowtime = (date("Y-m-d H:i:s"));
                $_SESSION['expire'] = $_SESSION['startTime']; // ending a session in 30 Min
                // checking the time now when home page starts
                $rout_time = $nowtime - $_SESSION['expire'];
                $localhost = ($this->request->getServer('HTTP_HOST'));
                $page = "http://" . $localhost . "/salts/auth/index/failerUser";
                $sec = "10";
                // header("Refresh: $sec; url=$page");
                if ($nowtime > $_SESSION['expire']) {
                    session_destroy();
                }
                return true;
            }
        }
    }

    public function saltsForGetAction() {
      //  $Core = new Models\CoreMember();
        $login = $this->request->getPost('SaltsForGetInput');
        $user = Users::findFirstByLogin($login);
        if ($user) {
            $this->view->disable();
            $this->response->redirect('setting/index/index');
        }
    }

    public function sendMailAction() {
        $filter = new Filter();
        $member_mail = $filter->sanitize($this->mailParam, "string");
        $Admin = new \salts\Auth\Models\CoreMember();
        $result = $Admin::findFirst("member_mail = '" . $member_mail . "' AND deleted_flag = 0 ");
        if ($result) {
             return true;
        } else {
            echo 'Error';
        }
    }

    public function checkMailAction() {
        $filter = new Filter();
        $member_mail = $filter->sanitize($this->mailParam, "string");
        $Admin = new \salts\Auth\Models\CoreMember();
        $result = $Admin::findFirst("member_mail = '" . $member_mail . "' AND deleted_flag = 0 ");
        if ($result) {
            $msg = "success";
        } else {
            $msg = "fail";
        }

        return $msg;
    }

    public function resetPasswordAction() {
        $filter = new Filter();
        $member_mail = $filter->sanitize($this->mailParam, 'string');
        $Admin = new \salts\Auth\Models\CoreMember();
        $result = $Admin::find( array("member_mail = '$member_mail'","deleted_flag = 0"));
        $data = [];
        foreach ($result as $value) {
            $data[] = $value->member_profile;
            $data[] = $value->member_mail;
            $data[] = $value->member_login_name;
        }
        return $data;
    }

    public function changePasswordAction() {
        $filter = new Filter();
        $newpass = $this->pwd;
        $member_mail = $filter->sanitize($this->mailParam, 'string');
        $Up = new \salts\Auth\Models\CoreMember();
        $result = $Up::find(array("member_mail = '$member_mail'","deleted_flag = 0"));
        foreach ($result as $value) {
            $value->member_password = sha1($newpass);
            $value->update();
        }
        if ($value) {
            $msg = "success";
        } else {
            $msg = "fail";
        }
        return $msg;
    }

    public function checkCodeAction() {
        $filter = new Filter();
        $code = $this->pwd;
        $email = $filter->sanitize($this->mailParam, "string");
        $FindCode = new \salts\Auth\Models\CoreForgotPassword();
        $result = $FindCode::find(array("check_mail = '$email'","order" => "curdate DESC","limit" => 1));
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

    public function sendToMailAction() {
        $filter = new Filter();
        $getemail = $filter->sanitize($this->mailParam, 'string');
        $Insert = new \salts\Auth\Models\CoreForgotPassword();
        $token = uniqid(bin2hex(mcrypt_create_iv(1, MCRYPT_DEV_RANDOM)));
        $Insert->check_mail = $getemail;
        $Insert->token = $token;
        $Insert->save();
        $Find = $Insert::find(array("check_mail = '$getemail'", "order" => "curdate DESC", "limit" => 1));
        foreach ($Find as $value) {   $finded_token = $filter->sanitize($value->token, "string"); }
        $to = $getemail;
        $subject = 'The subject';
        $message = $finded_token;
        $headers = 'From: sawzinminmin@gmail.com' . "\r\n" . 'Reply-To: sawzinminmin@gmail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        if (mail($to, $subject, $message, $headers)) {
            $msg = "success";
        } else {
            $msg = "fail";
        }
        $this->view->disable();
        echo json_encode($msg);
    }

}
