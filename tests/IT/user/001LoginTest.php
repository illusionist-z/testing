<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginTest
 *
 * @author Khine Thazin Phyo <ktzp27@gmail.com>
 */
class LoginTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
        $this->setBrowserUrl('http://localhost/salts');
        $this->prepareSession()->currentWindow()->maximize();
    }


    public function testLoginSuccess() {
        $this->prepareSession()->cookie()->clear();
        $this->url('index');
        $form = $this->byId('form_login');
        $company = $this->byName('company_id');
        $username = $this->byName('member_login_name');
        $password = $this->byName('password');
        $company->value('gnext');
        $username->value('sawzinmintun');
        $password->value('123');
        $form->submit();
        $this->assertEquals('Salts', $this->title());
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
