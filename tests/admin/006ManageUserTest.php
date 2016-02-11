<?php

/**
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class ManageUserTest extends PHPUnit_Extensions_Selenium2TestCase {

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

    public function testManageuser() {

        $this->url('index.phtml');
        $manageuser = $this->byId('pointer_style1');
        $manageuser->click();
        $this->assertEquals('Manage User', $this->title());
        $this->url('manageuser/index/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('User Lists', $element->text());
    }

    public function testSearch() {

        $this->url('index.phtml');
        $manageuser = $this->byId('pointer_style1');
        $manageuser->click();
        $searchclick = $this->byId('userlistsearch');
        $searchbox = $this->byName('username');
        $searchbox->value('phalcon');
        $searchclick->click();
        $this->url('manageuser/index/index');
    }

    public function testFirst() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style1');
        $list->click();

        $this->byLinkText('First')->click();
        $this->url('manageuser/index/index');
    }

    public function testNext() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style1');
        $list->click();

        $this->byLinkText('Next')->click();
        $this->url('manageuser/index/index');
    }

    public function testLast() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style1');
        $list->click();

        $this->byLinkText('Last')->click();
        $this->url('manageuser/index/index');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
