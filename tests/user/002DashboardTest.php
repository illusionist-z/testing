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
//include 'Helper.php';
//require_once 'vendor/autoload.php';

class DashboardTest extends PHPUnit_Extensions_Selenium2TestCase {

    //put your code here
    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost/salts');
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for DeshboardPage or not
     */
    public function testMenu() {
        $this->url('index.phtml');
        $form = $this->byId('form_login');
        $company = $this->byName('company_id');
        $username = $this->byName('member_login_name');
        $password = $this->byName('password');
        $company->value('cop1');
        $username->value('malkhin');
        $password->value('123');
        $form->submit();
        $this->assertEquals('Dashboard', $this->title());
//        Helper::testLoginSuccess();
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

    



}
