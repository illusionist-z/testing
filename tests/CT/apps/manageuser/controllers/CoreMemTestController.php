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
        $file_contents = 0;
        $_FILES['fileToUpload'] = $this->file;
        if (($_FILES['fileToUpload']['size']) != 0) {
            $file_type = $_FILES['fileToUpload']['type'];
            $file_size = $_FILES['fileToUpload']['size'];
            $tmp = (dirname(__DIR__) . '\tmp' . $this->file["tmp_name"]);
            $_FILES['fileToUpload']['tmp_name'] = $tmp;
            $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
            $file = fopen($MY_FILE, 'r');
            $file_content = fread($file, filesize($MY_FILE));
            fclose($file);
            $file_contents = addslashes($file_content);
            if (($file_size > 10000)) {
                $result = $this->checkimgsize();
                return $result;
            } elseif (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")
            ) {
                $result = $this->checkimgtype();
                return $result;
            } else {
                $member = $this->param;
                $member_id = $this->session->user['member_id'];
                $NewUser = new CoreMember;
                $NewUser->addNewUser($member_id, $member, $file_contents);
                $json['result'] = "success";
                return $json;
            }
        }
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
