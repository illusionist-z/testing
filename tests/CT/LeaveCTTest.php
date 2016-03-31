<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttendanceCITest
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 * edited by Khine Thazin Phyo
 * reject noleave leavemost
 */
require_once 'apps/Leavedays/controllers/LeaveIndexController.php';


if (!isset($_SESSION))
    $_SESSION = array();

class LeaveCTTest extends PHPUnit_Framework_TestCase {

    public function testautolistAction() {
        $action = new LeaveIndexController();
        $this->assertTrue($action->autolistAction());
    }

    public function testgetapplymemberidAction() {
        $uname = 'admin';
        $member = new LeaveIndexController();
        $member->setusername($uname);
        $test = array('member_id' => 'admin');
        $result = $member->getapplymemberidAction();
        $this->assertEquals("admin", $result[0]["member_id"]);
    }

    public function testapplyleaveAction() {
        $appleave = new LeaveIndexController();
        $this->assertTrue($appleave->applyleaveAction());
    }

    public function testcheckapplyAction() {
        $appleave = new LeaveIndexController();
        $appleave->setStatus(1);
        $result = $appleave->checkapplyAction();
        $this->assertEquals(" * Username is required", $result['username']);
        $this->assertEquals(" * Start Date is required", $result['sdate']);
        $this->assertEquals(" * End Date is required", $result['edate']);
        $this->assertEquals(" * Reason Must be Insert", $result['description']);
    }

    public function testcheckapplySuccessaction() {
        $appleave = new LeaveIndexController();
        $leave = array("uname" => "1fe9f520-c89a-11e5-9e13-4c3488333b45",
            "sdate" => "2016-04-06 00:00:00", "edate" => "2016-04-08 00:00:00",
            "type" => "donation", "desc" => "family donation");
        $appleave->setinfo($leave);
        $result = $appleave->checkapplyAction();
        $this->assertEquals("Your Leave Applied Successfully!", $result['success']);
    }

    public function testleavelistAction() {
        $leaveaction = new LeaveIndexController();
        $this->assertTrue($leaveaction->leavelistAction());
    }

    public function testleavesettingAction() {

        $leavesetting = new LeaveIndexController();
        $result = $leavesetting->leavesettingAction();
        $this->assertContains("Family Case", $result[0]['leavetype_name']);
    }

    public function testaddListTypeAction() {
        $ltype_name = 'Family Case';
        $addlist = new LeaveIndexController();
        $addlist->setltype_name($ltype_name);
        $this->assertEquals("Family Case", $addlist->addListTypeAction());
    }

    public function testdeleteListTypeAction() {
        $leave = new LeaveIndexController();
        $this->assertTrue($leave->deleteListTypeAction());
    }

    public function testeditleavesettingAction() {
        $edit_day = 16;
        $editleaveday = new LeaveIndexController();
        $editleaveday->setmax_leavedays($edit_day);
        $this->assertTrue($editleaveday->editleavesettingAction());
    }

    public function testacceptleaveAction() {
        $id = '1fe9f520-c89a-11e5-9e13-4c3488333b45';
        $leave_days = 2;
        $noti_id = 25926;
        $accept_leave = new LeaveIndexController();
        $accept_leave->setId($id);
        $accept_leave->setmax_leavedays($leave_days);
        $accept_leave->setNoti($noti_id);
        $this->assertTrue($accept_leave->acceptleaveAction());
    }


    public function testapplyautolistAction() {
        $apply_auto = new LeaveIndexController();
        $this->assertTrue($apply_auto->applyautolistAction());
    }

    public function testltyaddAction() {
        $leave = new LeaveIndexController();
        $result = $leave->ltyaddAction();
        $this->assertContains("addleavetype", $result[1]['addleavetype']);
    }

    public function testltypediaAction() {
        $id = '1fe9f520-c89a-11e5-9e13-4c3488333b45';
        $leave = new LeaveIndexController();
        $leave->setId($id);
        $result = $leave->ltypediaAction();
        $this->assertContains("donation", $result[0]['leave_category']);
    }


    public function testdetailAction() {
        $leave = new LeaveIndexController();

        $this->assertTrue($leave->detailAction());
    }

}
