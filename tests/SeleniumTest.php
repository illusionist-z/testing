<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SeleniumTest extends PHPUnit_Extensions_Selenium2TestCase {

    function setUp() {
       
        $this->setHost('localhost');
        $this->setPort(4444);              
        $this->setBrowser('firefox');
        $this->url('http://localhost:4444/wd/hub');        
        $this->setBrowserUrl('http://localhost/testing');
    }

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

    public function testTitle() {
        $this->url('index.php');
        $this->assertEquals('Hello', $this->title());
    }

    public function testHasLoginForm() {
        $username = 'test';
        $password = '1234';

        $this->url("login/login.php");
        $usernameInput = $this->byName("username");
        $usernameInput->clear();
        $this->keys($username);

        $usernameInput = $this->byName("password");
        $usernameInput->clear();
        $this->keys($password);
        $this->byName('login')->submit();
        $this->url("login/logout.php");
        $this->assertEquals('logout', $this->title());
    }

}

?>