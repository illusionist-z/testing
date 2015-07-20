<?php

namespace workManagiment\Manageuser\Controllers;
use workManagiment\Manageuser\Models\User as User;
/**
 * @author David
 * @type   User Editing
 * @data   Abstract User Model as $user
 */
class UserController extends ControllerBase {
    public $user;
    public function initialize() {
        parent::initialize();
        $this->user = new User();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/popup.js');
        $this->assets->addJs('apps/manageuser/js/useredit.js');
        $this->assets->addCss('common/css/dialog.css');
    }

    public function userlistAction() {       
        $list = $this->user->userlist();
        $this->view->setVar('username', $list);
        $this->view->setVar('type', 'userlist');
    }
    /**
     * @get data for user id
     * @return user data to dialog box
     * @author David
     * @since 20/7/15
     */
    public function usereditAction() {        
        $name = $this->request->get('data');        
        $edit = $this->user->useredit($name);
        $this->view->setVar('edituser', $edit);
        $this->view->setVar('type', 'useredit');
    }

}
