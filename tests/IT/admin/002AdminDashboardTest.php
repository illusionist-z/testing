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
        $helpicn = $this->byId('btn_cmn_help'); //change
        $helpicn->click();
        $this->url('help/index/searchHelp');
    }

    public function testNotiicon() {
        $this->url('dashboard/index/admin');
        $notiicn = $this->byId('noti');
        $notiicn->click();
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
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testCheckOut() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.checkout')->click();   //change       
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    public function testViewAll() {

        $this->url('dashboard/index/admin');
        $this->byId('noleavelistblock')->click();  
        $this->url('leavedays/index/noleavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("People who take no leave", $element->text());
    }

    public function testStaffnoAtt() {

        $this->url('dashboard/index/admin');
        $elements = $this->elements($this->using('css selector')->value('img.imgstyle'));
        $this->assertEquals(2, count($elements));
        $link = $this->byLinkText($elements[1]->text());
        $link->click();
        $this->url('attendancelist/absent/absentlist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Absent Lists', $element->text());
    }

    public function testStaffAtt() {

        $this->url('dashboard/index/admin');
        $elements = $this->elements($this->using('css selector')->value('img.imgstyle'));
        $this->assertEquals(2, count($elements));
        $link = $this->byLinkText($elements[0]->text());
        $link->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testDropdownAtt() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->byLinkText('Attendance List')->click();
        $this->url('attendancelist/index/todaylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Today Attendance List', $element->text());
    }

    public function testDropdownMang() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->byLinkText('Manage User')->click();
        $this->url('manageuser/index/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('User Lists', $element->text());
    }

    public function testDropdownLeave() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->byLinkText('Leave days')->click();
        $this->url('leavedays/index/leavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Leave Lists', $element->text());
    }

    public function testDropdownDocument() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->byLinkText('Document')->click();
        $this->url('document/index/letterhead');
    }

    public function testDropdownSsb() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->url('document/index/letterhead');
        $this->byLinkText('SSB Document')->click();
        $this->url('document/index/ssbdocument');
    }

    public function testDropdownTaxDocu() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->url('document/index/letterhead');
        $this->byLinkText('Tax document')->click();
        $this->url('document/index/taxdocument');
    }

    public function testDropdownSalarreferDocu() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->url('document/index/letterhead');
        $this->byLinkText('Salary Refer Document')->click();
        $this->url('document/index/salaryrefer');
    }

    public function testSetting() {

        $this->url('dashboard/index/admin');
        $this->byCssSelector('a.sidebar-toggle')->click();
        $this->byLinkText('Setting')->click();
        $this->url('setting/index');
         $element = $this->byCssSelector('h3');
        $this->assertEquals('Group Rule Setting', $element->text());
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
