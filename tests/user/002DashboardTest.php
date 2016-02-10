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
