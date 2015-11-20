<?php

namespace workManagiment\Auth\Controllers;
 use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
    
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

    public function forgotpasswordAction() {
        
    }
    
    public function SaltsForGetAction()
    {
        $core = new CoreMember();
        $login = $this->request->getPost('SaltsForGetInput');
        $user = Users::findFirstByLogin($login);
        if ($user) {
               $this->view->disable();
              $this->response->redirect('setting/index/index');
         }
    }

}

 