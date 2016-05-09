<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManageUserCTTest
 *
 * @author Khine Thazin Phyo <ktzp27@gmail.com>
 */
require_once 'apps/manageuser/controllers/ManageIndexController.php';
require_once 'apps/manageuser/controllers/CoreMemTestController.php';

if (!isset($_SESSION))
    $_SESSION = array();

class ManageUserCTTest extends PHPUnit_Framework_TestCase {

    public function testindexAction() {
        $controller = new ManageIndexController();
        $permission = 1;
        $this->assertEquals($permission, $controller->indexAction());
    }

    public function testusernameautolistAction() {
        $test = new ManageIndexController();
        $this->assertTrue($test->usernameautolistAction());
    }

    public function testmanageNewUserAction() {
        $test = new ManageIndexController();
        $test->setdata("new");
        $this->assertTrue($test->manageuserAction());
    }

    public function testgetpermitAction() {
        $permit = new ManageIndexController();
        $row = $permit->getpermitAction();
        $this->assertContains(array("group_id" => 4, "name_of_group" => "USER"), $row->toArray());
    }

    public function testcheckvalidation() {
        $cormember = new CoreMemTestController();

        $result = $cormember->checkuser("");
        $this->assertEquals("User Name is required", $result['uname']);
        $this->assertEquals("working start date is required", $result['work_sdate']);
        $this->assertEquals("Department is required", $result['dept']);
        $this->assertEquals("Position is required", $result['position']);
        $this->assertEquals("Password is required", $result['password']);
        $this->assertEquals("Confirm Password is required", $result['confirm']);
        $this->assertEquals("Email not valid", $result['email']);
        $this->assertEquals("Telephone Number is required", $result['phno']);
    }

    public function testsavenewuser() {
        $cormember = new CoreMemTestController();
        $meminfo = array("uname" => 'John', "work_sdate" => '2016-04-01',
            "dept" => 'PHP', "position" => "SE",
            "password" => "admin", "confirm" => "admin",
            "email" => "john@gmail.com", "phno" => "0152346",
            "user_role" => "USER,4", "full_name" => "John Smit",
            "bank" => "888307999978901", "address" => "Yangon","mm_name" => "ေအာင္ေအာင္","ssn" => "90033.35.3.1.1500");      
        $cormember->setparam($meminfo);
        $result = $cormember->savenewuser();
        $this->assertEquals("success", $result['result']);
    }

    public function testcheckuser() {
        $cormember = new CoreMemTestController();
        $result = $cormember->checkuser("John");
        $this->assertEquals("Name already taken ! Choose Other Please!", $result['uname']);
    }

    public function testUserDataEditAction() {
        $test = new ManageIndexController();
        $meminfo = array("uname" => 'Zin', "work_sdate" => '2016-04-01',
            "dept" => 'Android', "position" => "SE",
            "email" => "zin@gmail.com", "phno" => "01572670",
            "full_name" => "Zin Phyo","mm_name" => "ေအာင္ေအာင္",
            "bank" => "333307999978901", "address" => "Yangon","ssn" => "90055.35.3.1.1500");
        $test->setMeminfo($meminfo);
        $this->assertTrue($test->userdataeditAction());
    }

    public function testDeleteUserAction() {
        $test = new ManageIndexController();
        $this->assertTrue($test->deleteuserAction());
    }

}
