<?php

namespace salts\Auth\Controllers;
use salts\Core\Models\Db\CoreMember;
use salts\Auth\Models;

class LoginController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

    public function indexAction() {
        $loginParams = $this->request->get();
        $this->view->test = $loginParams;
        $ModelAuth = new Models\Auth();
        $result = $ModelAuth->check($loginParams, $user);
        $permission=$ModelAuth->getpermit($loginParams);
        $member=new CoreMember();
        $lang = $member->getlang($loginParams); 
        $this->session->set('language',$lang['lang']);
        $member->updatecontract($loginParams);
        $this->session->set('page_rule_group', $permission);
        $user = array();
        $this->session->set('user', $result);
        if ($result) {
             $ModelPermission = new Models\Permission();
            $permissions = [];
            //Set user's permission to session 
            $Permission = $ModelPermission->get($result, $permissions,$lang['lang']);
           //  print_r($Permission);exit;
            $this->session->set('auth', $Permission);
            $this->response->redirect('home');
        } else {
            //echo "error";exit;
            $this->response->redirect('auth/index/failer');
        }
       // When user's login succeed , move to dashboad
    }
    
    
}
