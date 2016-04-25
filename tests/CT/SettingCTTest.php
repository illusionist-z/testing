<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'apps\setting\controllers\SettingIndexController.php';
require_once 'apps\setting\models\CorePermissionGroupId.php';
if (!isset($_SESSION))
    $_SESSION = array();

class SettingCTTest extends PHPUnit_Framework_TestCase {

//    public function testindexAction() {
//        $setting = new SettingIndexController();
//        $this->assertTrue($setting->indexAction());
//    }

    public function testAddGroupRuleAction() {
        $setting = new SettingIndexController();
        $this->assertTrue($setting->AddGroupRuleAction());
    }

    public function testAddPageRuleAction() {
        $setting = new SettingIndexController();
        $this->assertTrue($setting->AddPageRuleAction());
    }

//    public function testDelGroupRuleAction() {
//        $setting = new SettingIndexController();
//        $this->assertTrue($setting->DelGroupRuleAction());
//    }
//
//    public function testDelPageRuleAction() {
//        $setting = new SettingIndexController();
//        $this->assertTrue($setting->DelPageRuleAction());
//    }
    public function testSettingModuleAction() {
        $setting = new SettingIndexController();
        $this->assertTrue($setting->SettingModuleAction());
    }

}
