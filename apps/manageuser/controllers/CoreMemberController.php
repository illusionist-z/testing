<?php

namespace salts\Manageuser\Controllers;

use salts\Manageuser\Models\User as User;
use salts\Manageuser\Models\AddUser;
use salts\Core\Models\Db\CoreMember;

/**
 * @author David
 * @type   User Editing
 * @data   Abstract User Model as $user
 */
class CorememberController extends ControllerBase {

    public $user;

    public function initialize() {
        parent::initialize();
        $this->user = new User();
        $this->setCommonJsAndCss();
        $this->setManageUserControllerJsAndCss();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
        $this->view->permission = $this->permission;
    }

    /**
     * ADD NEW USER 
     * @author Su Zin Kyaw
     * @version 26/8/2015 David
     * 
     */
    public function saveuserAction() {
        if ($this->permission == 1) {

            if ($this->request->isPost()) {
                $this->checkuser($this->request->getPost('uname'));
            }
        } else {
            echo 'Page Not Found';
        }
    }

    /*
     * check username is already taken or not
     */

    public function checkuser($id) {
        $json = array();
        $user = new AddUser();
        $exist_id = CoreMember::findByMemberLoginName($id);
        if (count($exist_id) > 0) {
            $json['uname'] = "Name already taken ! Choose Other Please!";
            $json['result'] = "existId";
            echo json_encode($json);
            $this->view->disable();
        } else {
            $validate = $user->validat($this->request->getPost());
            $this->checkvalidation($validate);
        }
    }

    /**
     * 
     * @param type $validate
     * check uservalidation
     */
    public function checkvalidation($validate) {
        if (count($validate)) {
            foreach ($validate as $message) {
                $json[$message->getField()] = $message->getMessage();
            }
            $json['result'] = "error";
            echo json_encode($json);
            $this->view->disable();
        } else {
            $this->savenewuser();
        }
    }

    /**
     * 
     * Insert new user 
     */
    public function savenewuser() {
        $file_contents = 0;
        if (($_FILES['fileToUpload']['size']) != 0) {
            $file_type = $_FILES['fileToUpload']['type'];
            $file_size = $_FILES['fileToUpload']['size'];
            $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
            $file = fopen($MY_FILE, 'r');
            $file_content = fread($file, filesize($MY_FILE));
            fclose($file);
            $file_contents = addslashes($file_content);
            if (($file_size > 10000)) {
                $this->checkimgsize();
            } elseif (($file_type != "image/jpeg") && ($file_type != "image/jpg") && ($file_type != "image/gif") && ($file_type != "image/png")
            ) {
                $this->checkimgtype();
            }
        }
        $member = $this->request->getPost();
        $member_id = $this->session->user['member_id'];
        $NewUser = new CoreMember;

        $NewUser->addNewUser($member_id, $member, $file_contents);
        $this->view->disable();
        $json['result'] = "success";
        echo json_encode($json);
    }

    public function checkimgsize() {
        $message = 'File too large. File must be less than 10 megabytes.';
        $error = '<script type="text/javascript">alert("' . $message . '");</script>';
        $json['result'] = $error;
        echo json_encode($json);
    }

    public function checkimgtype() {
        $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
        $error = '<script type="text/javascript">alert("' . $message . '");</script>';
        $json['result'] = $error;
        echo json_encode($json);
    }

}
