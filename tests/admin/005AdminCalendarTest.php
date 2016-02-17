<?php

/**
 * Description of dashboard
 * Test the ManageUser,Attendacne,Leave,Salary,Notification,Help, signout and setting,
 * check in ,check out and viewall.
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class AdminCalendarTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
       
        $this->setBrowserUrl('http://localhost/salts');
    }

    public function testTitle() {

        $this->url('index.php');
        $this->assertEquals('Login', $this->title());
    }

    public function testCalendarDropdown() {

        $this->url('index.phtml');
        $this->byCssSelector('img')->click();

        $this->byCssSelector('a')->click();
        $this->url('calendar/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Calendar', $element->text());
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
