<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SeleniumTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

    function setUp() {
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost/PhpSelenium');
    }

    public function testTitle() {
        $this->url('index.php');
        $this->assertEquals('Hell', $this->title());
    }

    public function testHasLoginForm() {
//        $this->url('login.php');
//        $username = $this->byId('uname')->value('someone');
//        $password = $this->byId('pword')->value('1234');
//        echo $username;
//        echo $password;
//        $this->byName('login')->submit();
//
//        $content = $this->byCssSelector('h4')->text();
//        $this->assertEquals('Right username or password', $content);
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
//        $content = $this->byCssSelector('h4')->text();
//        $this->assertEquals('Right username or password', $content);
//        $form = current($this->elements($this->using('css selector')->value('form.login')));
//        $form->submit();
//
//        /* Check for text on index page */
//        $h1 = current($this->elements($this->using('css selector')->value('h1')));
//        $this->assertEquals('Welcome to protected area!', $h1->text());
//
//        /* Check that cookie user has been set */
//        $authCookie = $this->cookie()->get('user');
//        $this->assertEquals('loggedin', $authCookie);
    }

}

?>