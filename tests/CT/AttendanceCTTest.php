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
 */
require_once 'apps/attendancelist/controllers/AttendancelistIndexController.php';
require_once 'apps/attendancelist/controllers/AttAbsentController.php';
require_once 'apps/attendancelist/controllers/AttUserController.php';

if (!isset($_SESSION))
    $_SESSION = array();

class AttendanceCTTest extends PHPUnit_Framework_TestCase {

    public function testtodaylistAction() {
        $name = new AttendancelistIndexController();
        $this->assertTrue($name->todaylistAction());
    }

    public function testeditTimedialogAction() {
        $id = '1621';
        $edit = new AttendancelistIndexController();
        $edit->setId($id);
        $this->assertTrue($edit->editTimedialogAction($id));
    }

    public function testeditTimeAction() {
        $id = '1598';
        $localtime = '2016-02-01 09:00:00';
        $attendance = new AttendancelistIndexController();
        $attendance->setOffset("-390");
        $this->assertTrue($attendance->editTimeAction($id, $localtime));
    }

    public function testmonthlylistAction() {
        $month = new AttendancelistIndexController();
        $this->assertTrue($month->monthlylistAction());
    }

    public function testattsearchAction() {
        $search = new AttendancelistIndexController();
        $this->assertTrue($search->attsearchAction());
    }

    public function testattendancechartAction() {
        $chart = new AttendancelistIndexController();
        $this->assertTrue($chart->attendancechartAction());
    }

    public function testautolistAction() {
        $autolist = new AttendancelistIndexController();
        $this->assertTrue($autolist->autolistAction());
    }

    /*
     * AbsentController function test
     */

    public function testaddAbsentAction() {
        $test = new AttAbsentController();
        $this->assertTrue($test->addAbsentAction());
    }

    public function testabsentlistAction() {
        $id = 'admin';
        $ablist = new AttAbsentController();
        $ablist->setID($id);
        $this->assertTrue($ablist->absentlistAction());
    }

    /*
     * UserController function test
     */

    public function testattendancelistAction() {
        $userlist = new AttUserController();
        $this->assertTrue($userlist->attendancelistAction());
    }

}
