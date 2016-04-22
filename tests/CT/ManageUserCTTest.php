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

//fixing
//    public function testUserDataEditAction() {
//        $test = new ManageIndexController();
//        $test->setdata('90e73464-c899-11e5-9e13-4c3488333b45');
//        $test->setname("Khine Thazin Phyo");
//        $test->setdept('PHP');
//        $test->setposition("Developer");
//        $test->setemail('bndream92@gmail.com');
//        $test->setpno("01572570");
//
//        $this->assertTrue($test->userdataeditAction());
//    }

    public function testgetpermitAction() {
        $permit = new ManageIndexController();
        $row = $permit->getpermitAction();
        $this->assertContains(array("group_id" => 4, "name_of_group" => "USER"), $row->toArray());
    }

    public function testcheckuser() {
        $cormember = new CoreMemTestController();
        $result = $cormember->checkuser("Ei Thandar Aung");
        $this->assertEquals("Name already taken ! Choose Other Please!", $result['uname']);
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
            "bank" => "888307999978901", "address" => "Yangon");
        $file = array("name" => "myfile.png", "type" => "image/png",
            "tmp_name" => "\myfile.png", "size" => 5);
        $cormember->setFile($file);
        $cormember->setparam($meminfo);
        $result = $cormember->savenewuser();
        $this->assertEquals("success", $result['result']);
    }

    public function testcheckimgsize() {
        $mesg = 'File too large. File must be less than 10 megabytes.';
        $cormember = new CoreMemTestController();
        $file = array("name" => "myfile.png", "type" => "image/png",
            "tmp_name" => "\myfile.png", "size" => 12220);
        $cormember->setFile($file);
        $msg = $cormember->savenewuser();
        $this->assertEquals($mesg, $msg['result']);
    }

    public function testcheckimgtype() {
        $mesg = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
        $cormember = new CoreMemTestController();
        $file = array("name" => "myfile.txt", "type" => "text/plain",
            "tmp_name" => "\myfile.tmp", "size" => 5);
        $cormember->setFile($file);
        $msg = $cormember->savenewuser();
        $this->assertEquals($mesg, $msg['result']);
    }

//fixing
//     public function testDeleteUserAction() {
//        $test = new ManageIndexController();
//        $data = "90e73464-c899-11e5-9e13-4c3488333b45";
//        $test->setdata($data);
//        $this->assertTrue($test->deleteuserAction());
//    }
}
