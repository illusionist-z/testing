<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use Phalcon\Config;
//use Phalcon\Mvc\Url as UrlProvider;

use salts\Setting\Controllers;
use salts\Setting\Models\CorePermissionGroup;
use salts\Setting\Models\CorePermissionGroupId;
use salts\Setting\Models\CorePermissionRelMember;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;
use Phalcon\Filter;

include_once 'tests\CT\apps\LoginForAll.php';

class SettingIndexController extends Controllers\IndexController {

    public $group_code;

    public function setGroupCode($group_code) {
        $this->group_code = $group_code;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->permission = 1;
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $Admin = new Db\CoreMember();
        foreach ($this->session->auth as $key_name => $key_value) {
            if ($key_name == 'show_admin_notification') {
                $noti = $Admin->GetAdminNoti($this->session->user['member_id'], 0);
            }
            if ($key_name == 'show_user_notification') {
                $noti = $Admin->GetUserNoti($this->session->user['member_id'], 1);
            }
        }
    }

    public function indexAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $permission = new \salts\Core\Models\Permission();
            $coreid = new CorePermissionGroupId();
            $corememberid = new CorePermissionRelMember();
            $coreuser = new CoreMember();
            $coreuser2 = new CorePermissionGroup();
            $currentPage = $this->request->get("page");
            $currentPage1 = $this->request->get("page1");
            $core_groupid = $coreid::find();
            $coremember = $corememberid::find();
            $core_groupuser22 = $coreuser2::find();
            $core_groupuser2 = $permission->pagination($core_groupuser22, $currentPage);
            $core_groupuser = $coreuser->getGroupId($currentPage1);
            //for paging without reload
            if ($this->request->has("type")) {
                $type = $this->request->get("type");
                if ($type == "page") {
                    $group_id = [$core_groupid->toArray(), $core_groupuser2];
                    echo json_encode($group_id);
                } elseif ($type == "user") {
                    $group_id = [$core_groupid->toArray(), $core_groupuser];
                    echo json_encode($group_id);
                }
                $this->view->disable();
            }
            $this->view->coreid = $core_groupid;
            $this->view->coremember = $coremember;
            $this->view->coreuser = $core_groupuser;
            $this->view->coreuser2 = $core_groupuser2;

            $id = $this->session->user['member_id'];
            $Noti = $coreuser->getAdminNoti($id, 0);
            $this->view->setVar("noti", $Noti);
        } else {
            $this->response->redirect('core/index');
        }
    }

    public function AddGroupRuleAction() {
        $this->initialize();
        $core = new CorePermissionGroupId();
        $core->save($this->group_code);
        $this->response->redirect('setting/index');
        return true;
    }

    public function AddPageRuleAction() {
        $this->initialize();
        $filter = new Filter();
        $creator_id = $filter->sanitize($this->session->user['member_id'], 'string');
        $created_dt = date("Y-m-d H:i:s");
        $core = new CorePermissionGroup();
        $option = explode("_", $this->group_code['page_rule_group']);
        $core->page_rule_group = $option[0];
        $core->permission_group_code = $option[1];
        $core->permission_group_name = strtolower($option[1]);
        $core->creator_id = $creator_id;
        $core->created_dt = $created_dt;
        $core->permission_code = $this->group_code['permission_code'];
        $core->save();
        $result = array("1" => $core->permission_code, "2" => $core->idpage);
        $this->response->redirect('setting/index');
        return $result;
    }

    public function DelGroupRuleAction() {
        $this->initialize();
        $core = CorePermissionGroupId::Find($this->request->getPost('group_id'));
        $core->delete();
        return true;
    }

    public function DelPageRuleAction() {
        $this->initialize();
        //$core = new CorePermissionGroup();

        $core = CorePermissionGroup::Find($this->request->getPost('idpage'));
        $core->delete();
        return true;
    }

    public function GroupRuleSettingAction() {
        $this->initialize();
        $filter = new Filter();
        $group_name = $filter->sanitize($this->group_code['name_of_group'], 'string');
        $core = CorePermissionGroupId::findFirst('group_id =' . $this->group_code['group_id']);
        $core->name_of_group = strtoupper($group_name);
        $core->update();
        $this->response->redirect('setting/index');
        return true;
    }

    public function User2RuleSettingAction() {
        $this->initialize();
        $filter = new Filter();
        $idpage = $filter->sanitize($this->group_code['idpage'], 'string');
        $page_rule_group = $filter->sanitize($this->group_code['page_rule_group'], 'string');
        $permission_code = $this->group_code['page_rule_group'];

        $core = CorePermissionGroup::findFirst('idpage=' . $idpage);
        $core->idpage = $idpage;
        $core->page_rule_group = $page_rule_group;
        $core->permission_code = $permission_code;
        $update = $core->update();
        if ($update) {
            $this->response->redirect('setting/index');
            return true;
        }
    }

    public function SettingModuleAction() {
        $UserList = new Db\CoreMember();
        $username = $UserList::getinstance()->getUserName("Khine Thazin Phyo");
        return true;
    }

}
