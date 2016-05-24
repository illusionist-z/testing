<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttendanceTest
 *
 * @author Khine Thazin Phyo <ktzp27@gmail.com>
 */
class AttendanceTest extends PHPUnit_Extensions_Selenium2TestCase {

    //put your code here
    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {

        $this->setBrowserUrl('http://localhost/salts');
        $this->prepareSession()->currentWindow()->maximize();
    }

    /**
     * Description of DashboardTest
     * @author Ei Lay
     * test for DeshboardPage or not
     */
    public function testMenu() {

        $this->url('attendancelist/user/attendancelist');
        
    }

    public function testSearch() {
        $this->url('attendancelist/user/attendancelist');
        $this->byId('frm_search');
        $exp = date("Y-m-d");
        $start_Date = $this->byId('startdate');
        $start_Date->value($exp);
        $end_Date = $this->byId('enddate');
        $end_Date->value($exp);
        $this->byCssSelector('input#search')->click();
        $this->assertEquals($exp, $this->byCssSelector('td')->text());
    }

    public function testExport() {

        $this->url('attendancelist/user/attendancelist');
        $this->byLinkText('Export')->click();
        $this->currentURL = $this->url('attendancelist/user/attendancelist');
       
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
