<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttendanceTest
 *
 * @author Su Zin Kyaw <gnext.suzin@gmail.com>
 */
class AttendanceTest extends PHPUnit_Extensions_Selenium2TestCase {

    //put your code here
    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {

        $this->setBrowserUrl('http://localhost/salts');
    }

    /**
     * Description of DashboardTest
     * @author Ei Lay
     * test for DeshboardPage or not
     */
    public function testMenu() {

        $this->url('attendancelist/user/attendancelist');
        $this->assertEquals('Attendance System', $this->title());
    }

    public function testSearch() {
        $this->url('attendancelist/user/attendancelist');
        $this->byId('frm_search');
        $start_Date = $this->byId('startdate');
        $start_Date->value('02/05/2016');
        $end_Date = $this->byId('enddate');
        $end_Date->value('02/05/2016');
        $this->byCssSelector('input#search')->click();
        $this->assertEquals("2016-02-05", $this->byCssSelector('td')->text());
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
