<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LeaveListTest
 *
 * @author Khine Thazin Phyo
 */
class LeaveListTest extends PHPUnit_Extensions_Selenium2TestCase {

    //put your code here
    public $currentURL = 'leavedays/user/leavelist';
    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
        $this->setBrowserUrl('http://localhost/salts');
    }

    /**
     * Description of LeaveListTest
     * @author khine thazin phyo 
     * test for leavelist page or not
     */
    public function testMenu() {
        $this->url('leavedays/user/leavelist');
        $this->assertEquals('Leave Lists', $this->byCssSelector('h1')->text());
    }

    /**
     * Description of LeaveListTest
     * @author khine thazin phyo 
     * test for nothing to show result if selected in dropdown
     */
    public function testSelect() {
        $this->url('leavedays/user/leavelist');
        $this->select($this->byId('ltype'))->selectOptionByValue("Family Case");
        $this->select($this->byId('month'))->selectOptionByValue('02');
        $this->byCssSelector('input.buttonn')->click();
        $this->assertEquals("2016-01-26", $this->byCssSelector('td')->text());
    }

    /**
     * Description of LeaveListTest
     * @author khine thazin phyo 
     * test for nothing to show if not selected in dropdown
     */
    public function testSelectNotShow() {
        $this->url('leavedays/user/leavelist');
        $this->select($this->byId('ltype'))->selectOptionByValue(NULL);
        $this->select($this->byId('month'))->selectOptionByValue(NULL);
        $this->byCssSelector('input.buttonn')->click();
        $this->assertEquals("No data to display", $this->byCssSelector('td')->text());
    }

    /**
     * Description of LeaveListTest
     * @author khine thazin phyo 
     * test for Leave List Link
     */
    public function testSidebarLeave() {
        $this->url('leavedays/user/leavelist');
        $this->byLinkText('Leave List')->click();
        $this->url('leavedays/user/leavelist');
        $this->assertEquals("Leave Lists", $this->byCssSelector('h1')->text());
    }

    /**
     * Description of LeaveListTest
     * @author khine thazin phyo 
     * test for first paging
     */
    public function testpagingFirst() {
        $this->url('leavedays/user/leavelist');
        $elements = $this->elements($this->using('css selector')->value('ul.pagination li'));
        $this->assertEquals(4, count($elements));
        $link = $this->byLinkText($elements[0]->text());
        $link->click();
    }

    public function testpaginationNP() {
        $this->url('leavedays/user/leavelist');
        $elements = $this->elements($this->using('css selector')->value('ul.pagination li'));
        $this->assertEquals(4, count($elements));
        $link = $this->byLinkText($elements[1]->text());
        $link->click();
    }

    public function testpaginationLast() {
        $this->url('leavedays/user/leavelist');
        $elements = $this->elements($this->using('css selector')->value('ul.pagination li'));
        $this->assertEquals(4, count($elements));
        $link = $this->byLinkText($elements[2]->text());
        $link->click();
    }

    /**
     * Description of LeaveListTest
     * @author khine thazin phyo 
     * test for ApplyLeave link
     */
    public function testApplyLeave() {
        $this->url('leavedays/user/leavelist');
        $this->byLinkText('Apply Leave')->click();
        $this->url('leavedays/user/applyleave');
        $this->assertEquals("applyleave", $this->byCssSelector('h1')->text());
    }

    public function testLeaveForm() {

        $this->url('leavedays/user/applyleave');
        $this->byId('apply_form');
        $start_Date = $this->byName('sdate');
        $start_Date->value('2016-02-15 00:00:00');
        $end_Date = $this->byName('edate');
        $end_Date->value('2016-02-17 13:32:41');
        $this->select($this->byName('leavetype'))->selectOptionByValue("On Vacation");
        $this->byCssSelector('textarea')->value("illness");
        $this->byCssSelector('input#apply_form_submit')->click();
        $this->url('leavedays/user/applyleave');
    }

    public function testLformValidation() {
        $this->url('leavedays/user/applyleave');
        $this->byId('apply_form');
        $start_Date = $this->byName('sdate');
        $start_Date->value("");
        $end_Date = $this->byName('edate');
        $end_Date->value("");
        $this->byCssSelector('textarea')->value("");
        $this->byId("apply_form_submit")->click();
        sleep(5);
        $elements = $this->elements($this->using('css selector')->value('td span'));
        $this->assertEquals(3, count($elements));
        $this->assertEquals('* Start Date is required', $elements[0]->text());
        $this->assertEquals('* End Date is required', $elements[1]->text());
        $this->assertEquals('* Reason Must be Insert', $elements[2]->text());
    }

    public function testFormReset() {
        $this->url('leavedays/user/applyleave');
        $this->byId('apply_form');
        $start_Date = $this->byName('sdate');
        $start_Date->value('2016-02-15 00:00:00');
        $end_Date = $this->byName('edate');
        $end_Date->value('2016-02-17 13:32:41');
        $this->select($this->byName('leavetype'))->selectOptionByValue("On Vacation");
        $this->byCssSelector('textarea')->value("illness");
        $this->byCssSelector('input#apply_form_cancel')->click();
        $this->url('leavedays/user/applyleave');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
