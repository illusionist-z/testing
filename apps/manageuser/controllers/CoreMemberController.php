<?php

namespace workManagiment\Manageuser\Controllers;

use Phalcon\Validation\Validator\Email as EmailValidator;
use workManagiment\Manageuser\Models\User as User;
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
        $this->assets->addCss('common/css/style.css');
        $this->assets->addJs('apps/manageuser/js/search.js');
    }

    /**
     * ADD NEW USER 
     * @author Su Zin Kyaw
     */
    public function saveuserAction() {

        $this->view->setVar('type', 'userlist');
        if ($this->request->isPost()) {
            $member_id = $this->session->user['member_id'];
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $dept = $this->request->getPost('dept');
            $position = $this->request->getPost('position');
            $email = $this->request->getPost('email');
            $phno = $this->request->getPost('phno');
            $address = $this->request->getPost('address');
            $role = $this->request->getPost('user_role');

            $filename = $_FILES["fileToUpload"]["name"];

            $NewUser = new CoreMember;
            $msg=$NewUser->addnewuser($member_id, $username, $password, $dept, $position, $email, $phno, $address, $filename, $role);
            $this->flashSession->success("$msg");

            // Make a full HTTP redirection
            return $this->response->redirect("manageuser/index/adduser");
        }
    }

}
