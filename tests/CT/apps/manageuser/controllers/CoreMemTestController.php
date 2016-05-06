<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Manageuser\Controllers;
use salts\Manageuser\Models\AddUser;
use salts\Core\Models\Db\CoreMember;

/**
 * Description of CorememberController
 *
 * @author Khine Thazin Phyo <ktzp27@gmail.com>
 */
class CoreMemTestController extends Controllers\CorememberController {

    public $user;
    public $param;
    public $member;
    public $memberId;
    public $file;

    public function setFile($file) {
        $this->file = $file;
    }

    public function setmemberId($memberId) {

        $this->memberId = $memberId;
    }

    public function setparam($param) {
        $this->param = $param;
    }

    public function setmember($member) {
        $this->member = $member;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function checkuser($id) {
        $this->initialize();
        $json = array();
        $user = new AddUser();
        $exist_id = CoreMember::findByMemberLoginName($id);
        if (count($exist_id) > 0) {
            $json['uname'] = "Name already taken ! Choose Other Please!";
            $json['result'] = "existId";
            return $json;
        } else {
            $validate = $user->validat($this->request->getPost());
            $result = $this->checkvalidation($validate);
            return $result;
        }
    }

    public function checkvalidation($validate) {
        if (count($validate)) {
            foreach ($validate as $message) {
                $json[$message->getField()] = $message->getMessage();
            }
            $json['result'] = "error";
            return $json;
        }
    }

    public function savenewuser() {
        $this->initialize();
        $member = $this->param;
        $member_id = $this->session->user['member_id'];
        $NewUser = new CoreMember;
        $NewUser->addNewUser($member_id, $member);
        $json['result'] = "success";
        return $json;
    }

    public function checkimgsize() {
        $message = 'File too large. File must be less than 10 megabytes.';
        $json['result'] = $message;

        return $json;
    }

    public function checkimgtype() {
        $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
        $json['result'] = $message;
        return $json;
    }

}
