<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardTest
 *
 * @author Khine Thazin Phyo 
 * 
 */
class DashboardTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
        $this->setBrowserUrl('http://localhost/salts');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for DeshboardPage or not
     */
    public function testMenu() {
        $this->url('index.phtml');
        $form = $this->byId('form_login');
        $this->byName('company_id')->value('cop1');
        $this->byName('member_login_name')->value('malkhin');
        $this->byName('password')->value('123');
        $form->submit();
        $this->assertEquals('Dashboard', $this->title());
        $this->url('index.php');
        $this->assertEquals('Dashboard', $this->title());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for chekbox
     */
    public function testCheckBox() {

        $checkbox = $this->byName('linkemail');
        $checkbox->click();
        $this->byCssSelector('textarea')->value("illness");
        $this->byCssSelector('.checkin')->click();
        $this->url('attendancelist/user/attendancelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("attendancelist", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for checkInbutton
     */
    public function testCheckIn() {
        $this->url('index.php');
        $this->byCssSelector('.checkin')->click();
        $this->url('attendancelist/user/attendancelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("attendancelist", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for checkoutbutton
     */
    public function testCheckout() {
        $this->url('index.php');
        $this->byCssSelector('.checkout')->click();
        $this->url('attendancelist/user/attendancelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("attendancelist", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Settingbutton
     */
    public function testSetting() {
        $this->url('index.php');
        $this->byCssSelector('.dropdown-toggle')->click();
        $this->byCssSelector('#setting')->click();
        $this->assertEquals("Admin Setting", $this->title());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for notification
     */
    public function testNoti() {
        $this->url('index.php');
        $this->byCssSelector('.noti')->click();
        $element = $this->byCssSelector('#notificationTitle');
        $this->assertEquals("Notifications", $element->text());
        sleep(1);
        $this->byCssSelector('img.img-circle')->click();
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Help
     */
    public function testHelp() {
        $this->url('index.php');
        $this->byCssSelector('#help_icon')->click();
        $this->url('help/index/searchHelp');
        $this->assertEquals("Search Help", $this->title());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Help Dashboard
     */
    public function testHelpDashboard() {
        $this->url('help/index/searchHelp');
        $this->byClassName('allhelpimg')->click();
        $this->assertEquals("Dashboard help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpAttendance() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Attendance List')->click();
        $this->byLinkText('Today Attendance Lists')->click();
        $this->assertEquals("Today Attendance List help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Attendance List')->click();
        sleep(2);
        $this->byLinkText('Monthly Attendance Lists')->click();
        $this->assertEquals("Monthly Attendance List help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Attendance List')->click();
        sleep(2);
        $this->byLinkText('Monthly Attendance Chart')->click();
        $this->assertEquals("Monthly Attendance Chart", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpManageUser() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Manage User')->click();
        $this->assertEquals("Manage User help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpLeaveDay() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Leave Days')->click();
        $this->byLinkText('Apply Leave')->click();
        $this->assertEquals("Apply Leave help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Leave Days')->click();
        sleep(2);
        $this->byLinkText('Leave Lists')->click();
        $this->assertEquals("Leave Lists help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Leave Days')->click();
        sleep(2);
        $this->byLinkText('Leave Setting')->click();
        $this->assertEquals("Leave Setting help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpCalendar() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Calendar')->click();
        $this->assertEquals("Calendar help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpSalary() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Salary')->click();
        $this->byLinkText('Add Salary')->click();
        $this->assertEquals("Add Salary help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        sleep(2);
        $this->byLinkText('Salary Lists')->click();
        $this->assertEquals("Salary List help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        sleep(2);
        $this->byLinkText('Monthly Salary Lists')->click();
        $this->assertEquals("(1) Monthly Salary Lists help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        sleep(2);
        $this->byLinkText('Salary Setting')->click();
        $this->assertEquals("Salary Setting help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        sleep(2);
        $this->byLinkText('Allowance')->click();
        $this->assertEquals("Allowance help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpDocument() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Document')->click();
        $this->byLinkText('Letter Head')->click();
        $this->assertEquals("Letter Head help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Document')->click();
        sleep(2);
        $this->byLinkText('SSB & Tax Document')->click();
        $this->assertEquals("SSB & Tax Document help center", $this->byId('searchhelpcenter')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Attendance link
     */
    public function testAttendance() {
        $this->url('index.php');
        $this->byCssSelector('div.top-row')->click();
        $this->url('attendancelist/user/attendancelist');
        $this->assertEquals("Attendance System", $this->title());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for leave link
     */
    public function testLeave() {

        $this->url('index.php');
        $elements = $this->elements($this->using('css selector')->value('div.top-row'));
        $this->assertEquals(2, count($elements));
        $link = $this->byLinkText($elements[1]->text());
        $link->click();
        $this->url('leavedays/user/leavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Leave Lists", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for SideMenu
     */
    public function testSidebar() {

        $this->url('index.php');
        $this->byCssSelector('img.sidebar-toggle')->click();
        $element = $this->byCssSelector('li.header');
        $this->assertEquals("MAIN NAVIGATION", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Attendance from sidemnu
     */
    public function testSidebarAttendance() {

        $this->url('index.php');
        $this->byCssSelector('img.sidebar-toggle')->click();
        $this->byLinkText('Attendance List')->click();
        $this->url('attendancelist/user/attendancelist');
        $this->assertEquals("attendancelist", $this->byCssSelector('h1')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for leave from sidemnu
     */
    public function testSidebarLeave() {

        $this->url('index.php');
        $this->byCssSelector('img.sidebar-toggle')->click();
        $this->byLinkText('Leave days')->click();
        $this->url('leavedays/user/leavelist');
        $this->assertEquals("Leave Lists", $this->byCssSelector('h1')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for dashboard from sidemnu
     */
    public function testSidebarCalendar() {

        $this->url('index.php');
        $this->byCssSelector('img.sidebar-toggle')->click();
        $this->byLinkText('Calendar')->click();
        $this->url('calendar/index/index');
        $this->assertEquals("Calendar", $this->byCssSelector('h1')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for dashboard from sidemnu
     */
    public function testSidebarDashboard() {

        $this->url('index.php');
        $this->byCssSelector('img.sidebar-toggle')->click();
        $this->byLinkText('Dashboard')->click();
        $this->url('dashboard/index/user');
        $this->assertEquals("Dashboard", $this->title());
    }

}
