<?php

/**
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class AttendanceListTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {

        $this->setBrowserUrl('http://localhost/salts');
        $this->prepareSession()->currentWindow()->maximize();
    }

    public function testAttdList() {
        $this->url('dashboard/index/admin');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testTodaySearch() {

        $this->url('attendancelist/index/todaylist');
        $form = $this->byCssSelector('input');
        $todaysearchbox = $this->byName('namelist');
        $todaysearchbox->value('admin');
        $form->submit();
    }

    public function testTodayEdit() {
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('.inedit')->click();
        sleep(3);
        $save = $this->byId('edit_attendance_edit');
        $this->waitUntil(function () {
            return $this->byId("time")->displayed();
        }, 2000);
        $atttime = $this->byId('time');
        $atttime->clear();
        $atttime->value('2016-02-05 09:24:00');
        $save->click();
        sleep(3);
        $this->url('attendancelist/index/todaylist');
    }

    public function testTodayExport() {
        $elements = $this->elements($this->using('css selector')->value('a#exbg'));
        $this->assertEquals(1, count($elements));
        $link = $this->byLinkText($elements[0]->text());
        sleep(3);
        $link->click();
        $this->url('attendancelist/index/todaylist');
    }

    public function testMonthlyList() {

        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/monthlylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Attendance List', $element->text());
    }

    public function testMonthlySearch() {
        $this->url('attendancelist/index/todaylist');

        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/monthlylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Attendance List', $element->text());
        $monthlysearchclick = $this->byId('sub');
        $monthlyyear = $this->byName('year');
        $monthlymonth = $this->byName('month');
        $monthlyuname = $this->byName('username');
        $monthlyyear->value('04/02/2016');
        $monthlymonth->value('15/02/2016');
        $monthlyuname->value('admin');
        $monthlysearchclick->click();
        sleep(2);
        $this->url('attendancelist/index/monthlylist');
    }

    public function testMonthlyExport() {

        $this->url('attendancelist/index/monthlylist');
        $elements = $this->elements($this->using('css selector')->value('img#exicon'));
        $this->assertEquals(1, count($elements));
        $link = $this->byLinkText($elements[0]->text());
        $link->click();
        $this->url('attendancelist/index/monthlylist');
    }

    public function testAttendanceChart() {

        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Attendance Chart (' . date("Y/m") . ')', $element->text());
    }


    public function testCancel() {
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byId("edit_attendance_close")->displayed();
        }, 2000);
        $this->byId('edit_attendance_close')->submit();
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
