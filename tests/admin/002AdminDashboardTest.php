<?php

/**
 * Description of dashboard
 * Test the ManageUser,Attendacne,Leave,Salary,Notification,Help, signout and setting,
 * check in ,check out and viewall.
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class AdminDashboardTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {

        $this->setBrowserUrl('http://localhost/salts');
    }

    public function testHelpicon() {
        $this->url('index.phtml');
        $form = $this->byId('form_login');
        $this->byName('company_id')->value('cop1');
        $this->byName('member_login_name')->value('admin');
        $this->byName('password')->value('admin');
        $form->submit();
        $this->url('index.phtml');
        $helpicn = $this->byId('help_icon');
        $helpicn->click();
        $this->url('help/index/searchHelp');
    }

    public function testNotiicon() {
        $this->url('index.phtml');
        $notiicn = $this->byId('noti');
        $notiicn->click();
    }

    public function testStaffAtt() {

        $this->url('index.phtml');
        $this->byCssSelector('a');
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testStaffAbs() {

        $this->url('index.phtml');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/absent/absentlist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Absent Lists", $element->text());
    }

    public function testCheck() {

        $this->url('index.phtml');
        $form = $this->byName('theForm');
        $element = $this->byName('linkemail');
        $element->click();
        $this->byCssSelector('textarea')->value("traffic");
        $this->byCssSelector('.checkin')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testSucessCheckIn() {

        $this->url('index.phtml');
        $this->byCssSelector('a.checkin')->click();
        $this->assertEquals(' Successfully Checked In', $this->alertText());
        $this->acceptAlert();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testAlreadyCheckIn() {

        $this->url('index.phtml');
        $this->byCssSelector('a.checkin')->click();
        $this->assertEquals('You have already check in', $this->alertText());
        $this->acceptAlert();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testCheckOut() {

        $this->url('index.phtml');
        $this->byCssSelector('a.checkout')->click();
        $this->assertEquals('Successfully Checked Out', $this->alertText());
        $this->acceptAlert();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testViewAll() {

        $this->url('index.phtml');
        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/noleavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("People who take no leave", $element->text());
    }

    public function testViewAllMember() {

        $this->url('index.phtml');
        $this->byCssSelector('a.uppercase')->click();
        $this->url('manageuser/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("User Lists", $element->text());
    }

    public function testDropdownDb() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('dashboard/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Dashboard', $element->text());
    }

    public function testDropdownAtt() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testDropdownMang() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('manageuser/index/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('User Lists', $element->text());
    }

    public function testDropdownLeave() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('User Lists', $element->text());
    }

    public function testDropdownCalendar() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('calendar/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Calendar', $element->text());
    }

    public function testDropdownDocument() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('document/index/letterhead');
    }

    public function testDropdownSsb() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();
        $this->byCssSelector('a')->click();
        $this->url('document/index/letterhead');
        $this->byCssSelector('a')->click();
        $this->url('document/index/ssbdocument');
    }

    public function testDropdownTaxDocu() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();
        $this->byCssSelector('a')->click();
        $this->url('document/index/letterhead');
        $this->byCssSelector('a')->click();
        $this->url('document/index/taxdocument');
    }

    public function testSetting() {

        $this->url('index.phtml');
        $this->byCssSelector('img.img-circle')->click();
        $this->byCssSelector('div.pull-left')->click();
        $this->url('setting/index/admin');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

//      public function testSignOut() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img.img-circle')->click();
//        $this->byId('btn_logout')->click();
//        $this->url('salts/auth');
//        
//      }
}
