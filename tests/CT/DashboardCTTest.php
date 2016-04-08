<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'apps/dashboard/controllers/IndexControllerTest.php';


/**
 * Description of DashboardCITest
 *
 * @author Khine Thazin Phyo <ktzp27@gmail.com>
 */
if (!isset($_SESSION))
    $_SESSION = array();

class DashboardCITest extends PHPUnit_Framework_TestCase {

//    //put your code here
    public function testadminAction() {

        $dashboard = new IndexControllerTest();
        $this->assertTrue($dashboard->adminAction());
    }

    public function testcheckinAction() {
        $dashboard = new IndexControllerTest();
        $expected = 'You have already check in';
        $this->assertEquals($expected, $dashboard->checkinAction());
    }

    public function testcheckoutAction() {
        $dashboard = new IndexControllerTest();
        $result = $dashboard->checkoutAction();
        $this->assertContains("Check", $result);
    }

    public function testUserAction() {
        $dashboard = new IndexControllerTest();
        $this->assertTrue($dashboard->userAction());
    }

    public function testLocation_SessionAction() {
        $dashboard = new IndexControllerTest();
        $this->assertTrue($dashboard->location_sessionAction());
    }

    public function testdirectAction() {
        $dashboard = new IndexControllerTest();
        $expected = $dashboard->directAction();
        if ($expected == 'admin_dashboard') {
            $this->assertEquals("admin_dashboard", $expected);
        } else {
            $this->assertEquals("user_dashboard", $expected);
        }
    }

}
