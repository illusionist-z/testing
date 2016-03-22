<?php

session_start();
require_once 'apps/auth/controllers/LoginControllerTest.php';
require_once 'apps/auth/controllers/AuthIndexController.php';
require_once 'apps/auth/controllers/LogoutControllerTest.php';

//namespace Test;


/**
 * Class LoginCITest
 */
if (!isset($_SESSION)) {

    $_SESSION = array();
}

class LoginCITest extends PHPUnit_Framework_TestCase {

    public function testindexAction() {

        $login_params = array('company_id' => 'gnext', "member_login_name" => "admin", "password" => "admin");
        $controller = new LoginControllerTest();
        $controller->setparam($login_params);
        $this->assertTrue($controller->indexAction());
    }

    public function testfailerAction() {
        $wrong_params = array('company_id' => 'gnext', "member_login_name" => "john", "password" => "admin");
        $test = new AuthIndexController();
        $test->setparam($wrong_params);
        $result = $test->failerAction(1);
        $expceted = 'company id or user name or password wrong';
        $this->assertEquals($expceted, $result);
    }

    public function testfailerUserAction() {
        $timestamp = (date("Y-m-d H:i:s"));
        $_SESSION['startTime'] = $timestamp;
        $wrong_params = array('company_id' => 'gnext', "member_login_name" => "malkhin", "password" => "balh");
        $test = new AuthIndexController();
        $test->setparam($wrong_params);
        $this->assertTrue($test->failerUserAction());
    }

//    public function testsaltsForGetAction() {
//        $wrong_params = array('company_id' => 'gnext', "member_login_name" => "admin", "password" => "admins");
//        $test = new AuthIndexController();
//        $test->setparam($wrong_params);
//        $this->assertTrue($test->saltsForGetAction());
//    }

    /*
     * did'not work in progress forgot password
     */

    public function testsendMailAction() {
        $email_params = 'ktzp27@gmail.com';
        $test = new AuthIndexController();
        $test->setmailParam($email_params);
        $this->assertTrue($test->sendMailAction());
    }

    public function testcheckMailAction() {
        $email_params = 'ktzp27@gmail.com';
        $test = new AuthIndexController();
        $test->setmailParam($email_params);
        $this->assertEquals("success", $test->checkMailAction());
    }

    public function testresetPasswordAction() {
        $email_params = 'ktzp27@gmail.com';
        $test = new AuthIndexController();
        $test->setmailParam($email_params);
        $result = $test->resetPasswordAction();
        $this->assertEquals($email_params, $result[1]);
    }

    public function testchangePasswordAction() {
        $email_params = 'ktzp27@gmail.com';
        $new_paswd = 'ktzp';
        $test = new AuthIndexController();
        $test->setmailParam($email_params);
        $test->setpwd($new_paswd);
        $this->assertEquals("success", $test->changePasswordAction());
    }

//    public function testsendToMailAction() {
//        $email_params = 'ktzp27@gmail.com';
//        $test = new AuthIndexController();
//        $test->setmailParam($email_params);
//        $this->assertTrue($test->sendToMailAction());
//    }

//    public function testLogoutIndexAction() {
//        
//      
//        $logout = new LogoutControllerTest();
//        $this->assertTrue($logout->indexAction());
//    }

//    public function testGetTranslateAction() {
//        $logout = new LogoutControllerTest();
//        $this->assertTrue($logout->gettranslateAction());
//    }
}
