<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CalendarTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    //put your code here
    function setUp() {
        $this->setBrowserUrl('http://localhost/salts');
    }

    public function testMenu() {
        $this->url('calendar/index/index');
        $this->assertEquals('Calendar', $this->byCssSelector('h1')->text());
    }

    public function testCancelAddMember() {
        $this->url('calendar/index/index');
        $this->byId('shapbott')->click();
        $this->assertEquals("Add New Members", $this->byCssSelector('span#ui-id-1')->text());
        $this->byId('member_event')->value('malkhin');
        $this->byCssSelector('a#member_event_dialog_close')->click();
    }

    public function testDeleteMember() {
        $this->url('calendar/index/index');
        $this->byCssSelector('a.disabledevent')->click();
        $this->assertEquals('You must check at least one', $this->alertText());
        $this->acceptAlert();
    }

    public function testShowEvent() {
        $this->url('calendar/index/index');
        $this->byCssSelector('span.btn-show-event')->click();
        $this->assertEquals('You must check at least one', $this->alertText());
        $this->acceptAlert();
    }

    public function testPrevButton() {
        $this->url('calendar/index/index');
        $this->byCssSelector('button.fc-prev-button')->click();
    }

    public function testNextButton() {
        $this->url('calendar/index/index');
        $this->byCssSelector('button.fc-next-button')->click();
    }

    public function testTodayButton() {
        $this->url('calendar/index/index');
        $this->byCssSelector('button.fc-today-button')->click();
    }

    public function testCancelEvent() {
        $this->url('calendar/index/index');
        $this->byCssSelector('td.fc-day-number')->click();
        $this->assertEquals("Create Event", $this->byCssSelector('span.ui-dialog-title')->text());
        $this->byCssSelector('input#reset_create_event')->click();
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
