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

    public function testNotiViewAll() {
        $this->url('index.phtml');
        $form = $this->byId('form_login');
        $company = $this->byName('company_id');
        $username = $this->byName('member_login_name');
        $password = $this->byName('password');
        $company->value('gnext');
        $username->value('admin');
        $password->value('admin');
        $form->submit();
        $viewall = $this->byLinkText('View All')->click();
        $this->url('notification/index/viewall');
        $this->assertEquals("Notifications", $this->byCssSelector('label#noti_title')->text());
    }

    public function testHelpicon() {
        $this->url('dashboard/index/admin');
        $helpicn = $this->byId('help_icon');
        $helpicn->click();
        $this->url('help/index/searchHelp');
        $this->assertEquals("Search Help", $this->title());
    }

    public function testNotiicon() {
        $this->url('dashboard/index/admin');
        $notiicn = $this->byId('noti');
        $notiicn->click();
    }

    public function testStaffAtt() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a');
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testStaffAbs() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a')->click();
        $this->url('attendancelist/absent/absentlist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Absent Lists", $element->text());
    }

    public function testCheck() {

        $this->url('dashboard/index/admin');
        $form = $this->byName('theForm');
        $element = $this->byName('linkemail');
        $element->click();
        $this->byCssSelector('textarea')->value("traffic");
        $this->byCssSelector('.checkin')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testAlreadyCheckIn() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.checkin')->click();
        $this->assertEquals('You have already check in', $this->alertText());
        $this->acceptAlert();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testCheckOut() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.checkout')->click();
        $this->assertEquals('Already Checkout', $this->alertText());
        $this->acceptAlert();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testViewAll() {

        $this->url('dashboard/index/admin');
        $this->byId('noleavelist')->click();
        $this->url('leavedays/index/noleavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("People who take no leave", $element->text());
    }

    public function testViewAllMember() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.uppercase')->click();
        $this->url('manageuser/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("User Lists", $element->text());
    }

    public function testDropdownDb() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('dashboard/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Dashboard', $element->text());
    }

    public function testDropdownAtt() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testDropdownMang() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('manageuser/index/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('User Lists', $element->text());
    }

    public function testDropdownLeave() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Leave Lists', $element->text());
    }

    public function testDropdownCalendar() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('calendar/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Calendar', $element->text());
    }

    public function testDropdownDocument() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('document/index/letterhead');
    }

    public function testDropdownSsb() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();
        $this->byCssSelector('a')->click();
        $this->url('document/index/letterhead');
        $this->byCssSelector('a')->click();
        $this->url('document/index/ssbdocument');
    }

    public function testDropdownTaxDocu() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img')->click();
        $this->byCssSelector('a')->click();
        $this->url('document/index/letterhead');
        $this->byCssSelector('a')->click();
        $this->url('document/index/taxdocument');
    }

    public function testSetting() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('img.img-circle')->click();
        $this->byCssSelector('div.pull-left')->click();
        $this->url('setting/index/admin');
    }


    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
