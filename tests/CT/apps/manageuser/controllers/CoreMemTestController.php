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

    public function setmemberId($memberId) {

        $this->memberId = $memberId;
    }

    public function setparam($param) {
        $this->param = $param;
    }

    public function setmember($member) {
        $this->member = $member;
    }

    //put your code her
    public function saveuserAction() {
        $login = new LoginForAll();
        $login->loginFirst();
        $json = array();
        //form validation init

        $user = new AddUser();
        $id = $this->param;

        $exist_id = CoreMember::findByMemberLoginName($id);
        if (count($exist_id) > 0) {

            $json['uname'] = "Name already taken ! Choose Other Please!";
            $json['result'] = "existId";

            return $json;
        } else {

            $validate = $user->validat($this->request->getPost());
            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";

                return $json;
            } else {
                echo "last";
                $member = $this->request->getPost();
                $member_id = $this->session->user[$this->memberId];
                $filename = $_FILES["fileToUpload"]["name"];
                $NewUser = new CoreMember;
                $NewUser->addNewUser($member_id, $member, $filename);

                // Make a full HTTP redirection
                $json['result'] = "success";
                echo json_encode($json);
            }
        }
    }

}
