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

include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/manageuser/controllers/IndexController.php';

/**
 * Description of IndexController
 *
 * @author Khine Thazin Phyo <gnext.ktzp27@gmail.com>
 */
class ManageIndexController extends Controllers\IndexController {

    public $user;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");
    public $data;
    public $name;
    public $dept;
    public $position;
    public $email;
    public $pno;

    public function setdata($data) {
        $this->data = $data;
    }

    public function setname($name) {
        $this->name = $name;
    }

    public function setdept($dept) {
        $this->dept = $dept;
    }

    public function setposition($position) {
        $this->position = $position;
    }

    public function setemail($email) {
        $this->$email = $email;
    }

    public function setpno($pno) {
        $this->pno = $pno;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();

       
    }

     public function manageuserAction() {
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
            $edit[1]["profile"] ="user_profile";
            $edit[1]["w_start_dt"] ="w_start_dt";
            $edit[1]['placeholder_ssn'] = "placeholder_ssn";
            $edit[1]['placeholder_bank'] = "placeholder_bank";
            $edit[1]["placeholder1"] = "placeholder1";
            $edit[1]["placeholder2"] = "placeholder2";
            $edit[1]["placeholder3"] ="placeholder3";
            $edit[1]["placeholder4"] = "placeholder4";
            $edit[1]["placeholder5"] ="placeholder5";
            $edit[1]["placeholder6"] = "placeholder6";
            $edit[1]["placeholder7"] = "placeholder7";
            $edit[1]["placeholder8"] ="placeholder8";
            $edit[1]["placeholder9"] = "placeholder9";
            $edit[1]["placeholder10"] = "placeholder10";
            $edit[1]["placeholder11"] = "placeholder11";
            $edit[1]["placeholder12"] = "placeholder12";
            return true;
            
        } else {
            $res = $this->user->userEdit($type);
            $edit[0] = $res[0];
            $edit[1]["edit"] = "edit_user";

            $edit[1]["id"] = "id";
            $edit[1]["bank"] = "bank";
            $edit[1]["name"] ="name";
            $edit[1]["dept"] = "dept";
            $edit[1]["pos"] = "position";
            $edit[1]["mail"] = "mail";
            $edit[1]["pno"] = "phone";
            $edit[1]["address"] = "address";
            $edit[1]["w_start_dt"] ="w_start_dt";
 
           $edit[1]["btn_edit"] = "btn_edit";
            $edit[1]["btn_delete"] = "btn_delete";
            $edit[1]["btn_cancel"] = "btn_cancel";
            echo json_encode($edit);
        }
        $this->view->disable();
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

    public function deleteuserAction() {
        $this->initialize();
        $id = $this->data;
        $this->user->userDelete($id);
        return true;
    }

    public function userdataeditAction() {
        $this->initialize();
        $cond = array();
        $cond['id'] = $this->data;
        $cond['bank'] = $this->request->get('bank');
        $cond['name'] = $this->name;
        $cond['dept'] = $this->dept;
        $cond['position'] = $this->position;
        $cond['email'] = $this->email;
        $cond['pno'] = $this->pno;
        $cond['address'] = $this->request->get('address');
        $cond['work_sdate'] = $this->request->get('work_sdate');
        $result = $this->user->editByCond($cond);
        return true;
    }

    public function getpermitAction() {
        $Permission = new Db\CorePermissionGroupId();
        $row = $Permission::find();

        return $row;
    }

}
