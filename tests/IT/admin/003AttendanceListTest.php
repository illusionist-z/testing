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
        $todaysearchclick = $this->byId('namesearch');
        $todaysearchbox = $this->byName('namelist');
        $todaysearchbox->value('admin');
        $todaysearchclick->click();
        sleep(2);
    }

    public function testTodayEdit() {

        $this->url('attendancelist/index/todaylist');
         $this->byCssSelector('.inedit')->click();
        sleep(3);
        $save = $this->byId('edit_attendance_edit');
        $atttime = $this->byId('time');
        $atttime->clear();
        $atttime->value('2016-02-05 09:24:00');
        $save->click();
        sleep(3);
        $this->url('attendancelist/index/todaylist');
    }

    public function testTodayExport() {

        $this->url('attendancelist/index/todaylist');        
        $this->byLinkText('Export')->click();
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
        
       
        $this->byLinkText('Export')->click();
        $this->url('attendancelist/index/monthlylist');
    }

    public function testAttendanceChart() {

        $this->url('attendancelist/index/todaylist');
        
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Attendance Chart (2016/05)', $element->text());
    }

    public function testFirst() {
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');

        $this->byLinkText('First')->click();
        $this->url('attendancelist/index/attendancechart');
    }

    public function testNext() {
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');

        $this->byLinkText('Next')->click();
        $this->url('attendancelist/index/attendancechart');
    }
    public function testLast() {

         $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/attendancechart');

        $this->byLinkText('Last')->click();
        $this->url('attendancelist/index/attendancechart');
    }

    public function testSave() {
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byCssSelector('input#time')->clear();
        $this->byCssSelector('input#time')->value('2016-02-18 14:06:52');        
    }
     public function testCancel() {
        $this->url('attendancelist/index/todaylist');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);       
        $this->byId('edit_attendance_close')->submit();       
    }


    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
