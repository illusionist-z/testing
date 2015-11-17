<?php

namespace workManagiment\Auth\Controllers;
use workManagiment\Core\Models\Db\CoreMember;
use workManagiment\Auth\Models;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

    public function indexAction($mode = NULL) {
        $this->view->errorMsg = '';
    }

    /**
     * When user failed login
     * @param type $mode
     */
    public function failerAction($mode = 1) {
        $this->view->errorMsg = 'IDもしくはパスワードが正しくありません。';
        $this->view->pick('index/index');
    }
    /**
     * When user failed  email  go 
     * @param type $mode
     */
    public function faileremailAction($mode = 1) {
        $this->view->errorMsg = 'IDもしくはパスワードが正しくありません。';
        $this->view->pick('index/forgotpassword');
    }
    
    public function forgotpasswordAction() {
       
    }
    public function findmemberAction() {
//       $member_mail = $this->request->getPost('emailaddress');       
//       //print_r($member_mail);exit;
//      // echo $member_mail;exit;
//         $ModelAuth = new Models\Auth();
//        $ModelAuth->find($member_mail);
    }
}
