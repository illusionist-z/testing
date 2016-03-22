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

    //put your code here
    public function testindexAction() {
        $controller = new ManageIndexController();
        $permission = 1;
        $this->assertEquals($permission, $controller->indexAction());
    }

    public function testusernameautolistAction() {
        $test = new ManageIndexController();
        $this->assertTrue($test->usernameautolistAction());
    }

    public function testmanageNewUserAction(){       
        $test = new ManageIndexController();
        $test->setdata("new");        
        $this->assertTrue($test->manageuserAction());
    }

    public function testDeleteUserAction() {
        $test = new ManageIndexController();
        $data = "9e6bda37-ebf0-11e5-be57-33c74e310ca9";
        $test->setdata($data);
        $this->assertTrue($test->deleteuserAction());
    }

    public function testUserDataEditAction() {
        $test = new ManageIndexController();
        $test->setdata('9e6bda37-ebf0-11e5-be57-33c74e310ca9');
        $test->setname("Khine Thazin Phyo");
        $test->setdept('PHP');
        $test->setposition("Developer");
        $test->setemail('ktzp27@gmail.com');
        $test->setpno("01572570");

        $this->assertTrue($test->userdataeditAction());
    }

    public function testgetpermitAction() {
        $permit = new ManageIndexController();
        $row = $permit->getpermitAction();
        $this->assertContains(array("group_id" => 4, "name_of_group" => "USER"), $row->toArray());
    }

    public function testSameNameSaveUserAction() {
        $cormember = new CoreMemTestController();
        $cormember->setparam("Khine Thazin Pyoe");
        $result = $cormember->saveuserAction();
        $this->assertEquals("Name already taken ! Choose Other Please!", $result['uname']);
    }

    public function testNotSameNameSaveUserAction() {
        $cormember = new CoreMemTestController();
        $cormember->setparam("John");
        $result = $cormember->saveuserAction();
        $this->assertEquals("User Name is required", $result['uname']);
    }

//    public function testSuccessNameSaveUserAction() {
//        $cormember = new CoreMemTestController();
//        $cormember->setmember("ktzp");
//        $cormember->setmemberId('9e6bda37-ebf0-11e5-be57-33c74e310ca9');
//        $result = $cormember->saveuserAction();
//        $this->assertEquals("User Name is required", $result['uname']);
//    }

}
