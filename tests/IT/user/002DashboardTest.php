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
        $this->prepareSession()->currentWindow()->maximize();
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
        $this->url('dashboard/index/user');
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for chekbox
     */
    public function testCheckBox() {
        $this->url('dashboard/index/user');
        $checkbox = $this->byName('linkemail');
        $checkbox->click();
        $this->waitUntil(function () {
            return $this->byCssSelector('div#xtraInfo')->displayed();
        }, 2000);
        $this->byCssSelector('div#xtraInfo textarea#note')->value("traffic");
        $this->byCssSelector('.checkin')->click();
        $this->url('attendancelist/user/attendancelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for checkInbutton
     */
    public function testCheckIn() {
        $this->url('dashboard/index/user');
        $this->byCssSelector('.checkin')->click();
        $this->url('attendancelist/user/attendancelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for checkoutbutton
     */
    public function testCheckout() {
        $this->url('dashboard/index/user');
        $this->byCssSelector('.checkout')->click();
        $this->url('attendancelist/user/attendancelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals("Today Attendance List", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Settingbutton
     */
    public function testSetting() {
        $this->url('dashboard/index/user');
        $this->byCssSelector('.dropdown-toggle')->click();
        $this->waitUntil(function () {
            return $this->byCssSelector('a#setting')->displayed();
        }, 2000);
        $this->byCssSelector('a#setting')->click();
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for notification
     */
    public function testNoti() {
        $this->url('dashboard/index/user');
        $this->byCssSelector('#noti')->click();
        $element = $this->byCssSelector('#hovernotiTitle');
        $this->assertEquals("Notifications", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Help
     */
    public function testHelp() {
        $this->url('dashboard/index/user');
        $this->byCssSelector('#btn_cmn_help')->click();
        $this->url('help/index/searchHelp');
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Help Dashboard
     */
    public function testHelpDashboard() {
        $this->url('help/index/searchHelp');
        $this->byClassName('allhelpimg')->click();
        $this->waitUntil(function () {
            return $this->byId('searchhelpcenter')->displayed();
        }, 2000);
        $this->assertEquals("Dashboard help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpAttendance() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Attendance List')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Today List')->displayed();
        }, 2000);
        $this->byLinkText('Today List')->click();
        $this->assertEquals("Today Attendance List help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Attendance List')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Monthly List')->displayed();
        }, 2000);
        $this->byLinkText('Monthly List')->click();
        $this->assertEquals("Monthly Attendance List help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Attendance List')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Monthly Chart')->displayed();
        }, 2000);
        $this->byLinkText('Monthly Chart')->click();
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
        $this->waitUntil(function () {
            return $this->byLinkText('Apply Leave')->displayed();
        }, 2000);
        $this->byLinkText('Apply Leave')->click();
        $this->assertEquals("Apply Leave help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Leave Days')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Leave Lists')->displayed();
        }, 2000);
        $this->byLinkText('Leave Lists')->click();
        $this->assertEquals("Leave Lists help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Leave Days')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Leave Setting')->displayed();
        }, 2000);
        $this->byLinkText('Leave Setting')->click();
        $this->assertEquals("Leave Setting help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpSalary() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Salary')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Add Salary')->displayed();
        }, 2000);
        $this->byLinkText('Add Salary')->click();
        $this->assertEquals("Add Salary help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Salary Lists')->displayed();
        }, 2000);
        $this->byLinkText('Salary Lists')->click();
        $this->assertEquals("Salary List help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Monthly Salary Lists')->displayed();
        }, 2000);
        $this->byLinkText('Monthly Salary Lists')->click();
        $this->assertEquals("(1) Monthly Salary Lists help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Salary Setting')->displayed();
        }, 2000);
        $this->byLinkText('Salary Setting')->click();
        $this->assertEquals("Salary Setting help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Salary')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Allowance')->displayed();
        }, 2000);
        $this->byLinkText('Allowance')->click();
        $this->assertEquals("Allowance help center", $this->byId('searchhelpcenter')->text());
    }

    public function testHelpDocument() {
        $this->url('help/index/searchHelp');
        $this->byLinkText('Document')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('Letter Head')->displayed();
        }, 2000);
        $this->byLinkText('Letter Head')->click();
        $this->assertEquals("Letter Head help center", $this->byId('searchhelpcenter')->text());
        $this->byLinkText('Document')->click();
        $this->waitUntil(function () {
            return $this->byLinkText('SSB')->displayed();
        }, 2000);
        $this->byLinkText('SSB')->click();
        $this->assertEquals("SSB & Tax Document help center", $this->byId('searchhelpcenter')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Attendance link
     */
    public function testAttendance() {
        $this->url('dashboard/index/user');
        $this->byCssSelector('div.top-row')->click();
        $this->url('attendancelist/user/attendancelist');
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for leave link
     */
    public function testLeave() {

        $this->url('dashboard/index/user');
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

        $this->url('dashboard/index/user');
        $this->byCssSelector('span#btn_show_menu')->click();
        $element = $this->byCssSelector('ul.sidebar-menu li.header');
        $this->assertEquals("MAIN NAVIGATION", $element->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for Attendance from sidemnu
     */
    public function testSidebarAttendance() {

        $this->url('dashboard/index/user');
        $this->byCssSelector('span#btn_show_menu')->click();
        $this->waitUntil(function () {
            return $this->byCssSelector("a#navicon11")->displayed();
        }, 2000);
        $this->byLinkText('Attendance List')->click();
        $this->url('attendancelist/user/attendancelist');
        $this->assertEquals("Today Attendance List", $this->byCssSelector('h1')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for leave from sidemnu
     */
    public function testSidebarLeave() {

        $this->url('dashboard/index/user');
        $this->byCssSelector('span#btn_show_menu')->click();
        $this->waitUntil(function () {
            return $this->byCssSelector("a#navicon21")->displayed();
        }, 2000);
        $this->byLinkText('Leave days')->click();
        $this->url('leavedays/user/leavelist');
        $this->assertEquals("Leave Lists", $this->byCssSelector('h1')->text());
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for dashboard from sidemnu
     */
    public function testSidebarDashboard() {

        $this->url('dashboard/index/user');
        $this->byCssSelector('span#btn_show_menu')->click();
        $this->waitUntil(function () {
            return $this->byCssSelector("a#navicon31")->displayed();
        }, 2000);
        $this->byLinkText('Dashboard')->click();
        $this->url('dashboard/index/user');
    }

}
