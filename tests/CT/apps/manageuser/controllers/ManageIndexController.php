<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Manageuser\Models\User as User;
use salts\Core\Models\Db;
use salts\Manageuser\Controllers;
use salts\Auth\Models;

/**
 * Description of IndexController
 *
 * @author Khine Thazin Phyo <gnext.ktzp27@gmail.com>
 */
class ManageIndexController extends Controllers\IndexController {

    public $user;
    public $data;
    public $meminfo;
    public $login_params = array('company_id' => 'gnext',
        "member_login_name" => "admin", "password" => "admin");

    public function setMeminfo($meminfo) {

        $this->meminfo = $meminfo;
    }

    public function setdata($data) {
        $this->data = $data;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
        $this->user = new User();
        $this->permission = 1;
    }

    public function manageuserAction() {
        $this->initialize();
        $type = $this->data;
        $edit = array();
        if ($type == 'new') {
            $edit[0] = $type;
            $edit[1]["add"] = "adduser";
            $edit[1]["ssn"] = "ssn_no";
            $edit[1]['bank'] = "bank";
            $edit[1]["name"] = "name";
            $edit[1]["username"] = "username";
            $edit[1]["pass"] = "password";
            $edit[1]["confirm"] = "confirm_pass";
            $edit[1]["dept"] = "dept";
            $edit[1]["pos"] = "position";
            $edit[1]["mail"] = "mail";
            $edit[1]["pno"] = "phone";
            $edit[1]["address"] = "address";
            $edit[1]["role"] = "user_role";
            $edit[1]["profile"] = "user_profile";
            $edit[1]["w_start_dt"] = "w_start_dt";
            $edit[1]['placeholder_ssn'] = "placeholder_ssn";
            $edit[1]['placeholder_bank'] = "placeholder_bank";
            $edit[1]["placeholder1"] = "placeholder1";
            $edit[1]["placeholder2"] = "placeholder2";
            $edit[1]["placeholder3"] = "placeholder3";
            $edit[1]["placeholder4"] = "placeholder4";
            $edit[1]["placeholder5"] = "placeholder5";
            $edit[1]["placeholder6"] = "placeholder6";
            $edit[1]["placeholder7"] = "placeholder7";
            $edit[1]["placeholder8"] = "placeholder8";
            $edit[1]["placeholder9"] = "placeholder9";
            $edit[1]["placeholder10"] = "placeholder10";
            $edit[1]["placeholder11"] = "placeholder11";
            $edit[1]["placeholder12"] = "placeholder12";
        } else {
            $res = $this->user->userEdit($type);
            $edit[0] = $res[0];
            $edit[1]["edit"] = "edit_user";

            $edit[1]["id"] = "id";
            $edit[1]["bank"] = "bank";
            $edit[1]["name"] = "name";
            $edit[1]["dept"] = "dept";
            $edit[1]["pos"] = "position";
            $edit[1]["mail"] = "mail";
            $edit[1]["pno"] = "phone";
            $edit[1]["address"] = "address";
            $edit[1]["w_start_dt"] = "w_start_dt";

            $edit[1]["btn_edit"] = "btn_edit";
            $edit[1]["btn_delete"] = "btn_delete";
            $edit[1]["btn_cancel"] = "btn_cancel";
        }
        return true;
    }

    //put your code here
    public function indexAction() {

        $this->initialize();
        $this->user = new User();
        $currentPage = $this->request->get('page');

        $this->assets->addJs("apps/manageuser/js/index-index.js");
        $this->assets->addJs('apps/manageuser/js/base.js');
        $getname = Db\CoreMember::getInstance()->getUserName($currentPage);
        $username = $this->request->get('username');
        $list = $this->user->userList($username, $currentPage);
        $member_count = new Db\CoreMember();
        $member_count_number = $member_count->getNumberCount();
        $ModelAuth = new Models\Auth();
        $permission = $ModelAuth->getPermit($this->login_params);
        if ($permission == 1) {

            return $permission;
        } else {
            $this->response->redirect('core/index');
        }
    }

    public function usernameautolistAction() {

        $this->initialize();
        $UserList = new Db\CoreMember();
        $Username = $UserList->autoUsername();

        return true;
    }

    public function userdataeditAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $UserList = new Db\CoreMember();
            $Username = $UserList->autoUsername();
            $id = $Username[18]['member_id'];
            $cond = array();
            $cond['id'] = $id;
            $cond['bank'] = $this->meminfo['bank'];
            $cond['name'] = $this->meminfo['uname'];
            $cond['ssn'] = $this->meminfo['ssn'];
            $cond['full_name'] = $this->meminfo['full_name'];
            $cond['mm_name'] = $this->meminfo['mm_name'];
            $cond['dept'] = $this->meminfo['dept'];
            $cond['position'] = $this->meminfo['position'];
            $cond['email'] = $this->meminfo['email'];
            $cond['pno'] = $this->meminfo['phno'];
            $cond['address'] = $this->meminfo['address'];
            $cond['work_sdate'] = $this->meminfo['work_sdate'];
            $result = $this->user->editByCond($cond);
            return true;
        }
    }

    public function deleteuserAction() {
        $this->initialize();
        $UserList = new Db\CoreMember();
        $Username = $UserList->autoUsername();
        $id = $Username[18]['member_id'];
        $this->user->userDelete($id);
        return true;
    }

    public function getpermitAction() {
        $Permission = new Db\CorePermissionGroupId();
        $row = $Permission::find();

        return $row;
    }

}