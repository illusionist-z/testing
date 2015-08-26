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
            $member = $this->request->getPost('member');
            //print_r($member);exit;
            

            $filename = $_FILES["fileToUpload"]["name"];

            $NewUser = new CoreMember;
            $msg=$NewUser->addnewuser($member_id, $member, $filename);
            echo "<script>alert('".$msg."');</script>";
            echo "<script type='text/javascript'>window.location.href='../index/adduser';</script>";
    
        }
    }

}
