<?php

namespace workManagiment\Auth\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->assets->addCss('/common/css/auth/auth.css');
        
    }

    
    public function indexAction($mode = NULL){
        $this->view->errorMsg = '';
    }
    
    /**
     * When user failed login
     * @param type $mode
     */
    public function failerAction($mode =1){
        $this->view->errorMsg = 'IDもしくはパスワードが正しくありません。';
        $this->view->pick('index/index');
    }
    

}

