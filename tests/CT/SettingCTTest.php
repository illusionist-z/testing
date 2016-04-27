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

    public function testindexPageAction() {
        $setting = new SettingIndexController();
        $setting->setType("page");
        $this->assertTrue($setting->indexAction());
    }

    public function testindexUserAction() {
        $setting = new SettingIndexController();
        $setting->setType("user");
        $this->assertTrue($setting->indexAction());
    }

    public function testAddGroupRuleAction() {
        $setting = new SettingIndexController();
        $setting->setGroupCode(array("page" => "Director"));
        $this->assertTrue($setting->AddGroupRuleAction());
    }

    public function testAddPageRuleAction() {
        $setting = new SettingIndexController();
        $code = array("permission_code" => "newpage", "page_rule_group" => "1_ADMIN");
        $setting->setGroupCode($code);
        $res = $setting->AddPageRuleAction();
        $this->assertEquals($code['permission_code'], $res[1]);
    }

    public function testSettingModuleAction() {
        $setting = new SettingIndexController();
        $this->assertTrue($setting->SettingModuleAction());
    }

    public function testGroupRuleSettingAction() {
        $setting = new SettingIndexController();
        $code = array("group_id" => "1", "name_of_group" => "Test");
        $setting->setGroupCode($code);
        $this->assertTrue($setting->GroupRuleSettingAction());
    }

    public function testUser2RuleSettingAction() {
        $setting = new SettingIndexController();
        $code = array("permission_code" => "newpage", "page_rule_group" => "1_ADMIN");
        $setting->setGroupCode($code);
        $res = $setting->AddPageRuleAction();
        $code2 = array("idpage" => $res[2], "permission_code" => "admin_home", "page_rule_group" => "1");
        $setting->setGroupCode($code2);
        $this->assertTrue($setting->User2RuleSettingAction());
    }

//    public function testUserRuleSettingAction() {
//        $setting = new SettingIndexController();
//        $code = array("permission_code" => "newpage", "page_rule_group" => "1_ADMIN");
//        $setting->setGroupCode($code);
//        $res = $setting->AddPageRuleAction();
//        $code2 = array("idpage" => $res[2], "permission_code" => "admin_home", "page_rule_group" => "1");
//        $setting->setGroupCode($code2);
//        $this->assertTrue($setting->UserRuleSettingAction());
//    }

    public function testDelGroupRuleAction() {
        $setting = new SettingIndexController();
        $setting->setGroupCode("3");
        $this->assertTrue($setting->DelGroupRuleAction());
    }

    public function testDelPageRuleAction() {
        $setting = new SettingIndexController();
        $setting->setGroupCode("4");
        $this->assertTrue($setting->DelPageRuleAction());
    }

}
