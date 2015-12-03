<?php

namespace workManagiment\Manageuser\Controllers;

use workManagiment\Manageuser\Models\User as User;
use workManagiment\Manageuser\Models\AddUser;
use workManagiment\Core\Models\Db;
use workManagiment\Core\Models\Db\CoreMember;

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
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');

        $this->assets->addJs('apps/manageuser/js/search.js');
    }

    /**
     * ADD NEW USER 
     * @author Su Zin Kyaw
     * @version 26/8/2015 David
     * 
     */
    public function saveuserAction() {
        $json = array();
        //form validation init
        if ($this->request->isPost()) {

            $user = new AddUser();            
            $id = $this->request->getPost('username');
            $exist_id = CoreMember::findByMemberLoginName($id);
            if (count($exist_id) > 0) {
                $json['uname'] = "Name already taken ! Choose Other Please!";
                $json['result'] = "existId";
                echo json_encode($json);
                $this->view->disable();
            } else {
                $validate = $user->validat($this->request->getPost());
                if (count($validate)) {
                    foreach ($validate as $message) {
                        $json[$message->getField()] = $message->getMessage();
                    }
                    $json['result'] = "error";
                    echo json_encode($json);
                    $this->view->disable();
                } else {

                    $member = $this->request->getPost();
                    $member_id = $this->session->user['member_id'];

                    $filename = $_FILES["fileToUpload"]["name"];
                    $NewUser = new CoreMember;
                    $NewUser->addnewuser($member_id, $member, $filename);

                    $this->view->disable();
                    // Make a full HTTP redirection
                    $json['result'] = "success";
                    echo json_encode($json);
                }
            }
        }
    }

}
