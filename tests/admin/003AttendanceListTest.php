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
    }

    public function testTitle() {

        $this->url('index.php');
        $this->assertEquals('Login', $this->title());
    }

    /**
     * 
     * @param type $euser
     * @author 
     * 
     */
    public function testAttdList() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->assertEquals('Attendance System', $this->title());
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testTodayList() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testTodaySearch() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $todaysearchclick = $this->byId('namesearch');
        $todaysearchbox = $this->byName('namelist');
        $todaysearchbox->value('admin');
        $todaysearchclick->click();
    }

    public function testTodayEdit() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byId('201');
        $element->click();

        $save = $this->byId('edit_attendance_edit');
        $atttime = $this->$byName('time');
        $atttime->value('2016-02-05 09:24:00');
        $save->click();
        $this->url('attendancelist/index/todaylist');
    }

    public function testTodayExport() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byLinkText('Export')->click();
        $this->url('attendancelist/index/todaylist');
    }

    public function testMonthlyList() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/monthlylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Attendance List', $element->text());
    }

    public function testMonthlySearch() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
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
        $monthlymonth->value('04/02/2016');
        $monthlyuname->value('admin');
        $monthlysearchclick->click();
        $this->url('attendancelist/index/monthlylist');
    }

    public function testMonthlyExport() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/monthlylist');
        $this->byLinkText('Export')->click();
        $this->url('attendancelist/index/monthlylist');
    }

    public function testAttendanceChart() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Attendance Chart (2016/02)', $element->text());
    }

    public function testFirst() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');

        $this->byLinkText('First')->click();
        $this->url('attendancelist/index/attendancechart');
    }

    public function testNext() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');

        $this->byLinkText('Next')->click();
        $this->url('attendancelist/index/attendancechart');
    }

    public function testLast() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style2');
        $list->click();
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');

        $this->byLinkText('Last')->click();
        $this->url('attendancelist/index/attendancechart');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
