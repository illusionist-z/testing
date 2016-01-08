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
        $ModelAuth = new Models\Auth();
        if(!isset($loginParams['company_id']))
            {
        $dbinfo['host']='localhost';
        $dbinfo['db_name']='company_db';
        $dbinfo['user_name']='root';
        $dbinfo['db_psw']='root';
        
        $this->session->set('db_config',$dbinfo);
        $result = $ModelAuth->check($loginParams, $user);
        if ($result) {
            $this->response->redirect('managecompany');
        } 
            }
        else{
        $this->view->test = $loginParams;
        
        $companyDB=$ModelAuth->findcomp_db($loginParams);
        $companyDB=1;
        if($companyDB)
        {
        $this->session->set('db_config',$companyDB);
       
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
            $this->session->set('auth', $Permission);
            $this->response->redirect('home');
        } 
        else {
            $this->response->redirect('auth/index/failer');
        }
        }
        else {
           $this->session->set('db_config',$companyDB);
           $this->response->redirect('auth/index/failer');
        }
        }
       // When user's login succeed , move to dashboad
    }
    
    
}
