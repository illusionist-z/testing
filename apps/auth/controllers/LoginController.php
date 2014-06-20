<?php

namespace Crm\Auth\Controllers;

use Crm\Auth\Models;

class LoginController extends ControllerBase
{

    public function indexAction()
    {
        $loginParams = $this->request->get();
        $this->view->test = $loginParams;
        $modelAuth = new Models\Auth();
        
        $user = array();
        if($modelAuth->check($loginParams,$user)){
            $modelPermission = new Models\Permission();
            $modelPermission->set($user);
        }
//            $this->logger->WriteException($e);
//          $user = $dbUser->findFirstByLogin($login);
//        $this->view->test = 'NG';
//        if ($user) {
//            if ($this->security->checkHash($password, $user->password)) {
//                //ログイン処理を追加
//                $this->view->test = 'OK';
//            }
//        }
            
    }
    
    

}

