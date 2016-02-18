<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginTest
 *
 * @author Su Zin Kyaw <gnext.suzin@gmail.com>
 */

class AdminLoginTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
        $this->setBrowserUrl('http://localhost/salts');

    }

    public function testLoginSuccess() {
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
    }

    /**
     * Description of DashboardTest
     * @author khine thazin phyo 
     * test for SignOutbutton
     */
    public function testSignOut() {
        $this->url('dashboard/index/admin');
        $this->byCssSelector('.dropdown-toggle')->click();
        $this->byCssSelector('#btn_logout')->click();
        $this->assertEquals("Login", $this->title());
    }

    public function testLoginFail() {
        $this->url('index.phtml');
        $form = $this->byId('form_login');
        $company = $this->byName('company_id');
        $username = $this->byName('member_login_name');
        $password = $this->byName('password');
        $company->value('cop1');
        $username->value('malkhin');
        $password->value('890');
        $form->submit();
        $elements = $this->elements($this->using('css selector')->value('p'));
        $this->assertEquals(2, count($elements));
        $this->assertEquals('company id or user name or password wrong', $elements[1]->text());
    }

    public function testForgetPassword() {
        $this->url('index.phtml');
        $this->byCssSelector('a')->click();
        $element = $this->byCssSelector('#forgottext');
        $this->assertEquals('FORGOT YOUR PASSWORD?', $element->text());
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
