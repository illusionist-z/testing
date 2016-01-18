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
        
        // Data Base Chack
        if ($result) {
            $this->response->redirect('managecompany');
        }
        else {
           
           $this->response->redirect('auth/index/failersuperuser');
        }
            }
        else{
            
        $this->view->test = $loginParams;
        $companyDB=$ModelAuth->findcomp_db($loginParams);
       // Data Base Hase
        if($companyDB)
        {
           
        //User Chack    
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
        
        date_default_timezone_set('Asia/Rangoon');
        $core = new CoreMember();
        //$tokenpush = uniqid(bin2hex(mcrypt_create_iv(50, MCRYPT_DEV_RANDOM)));
        $core->token = $tokenpush;
        $member_id = $this->request->getPost('member_login_name');
        $insert  = $core->tokenpush($tokenpush,$member_id);
         
        $timestamp = (date("Y-m-d j:i:s"));    
        $member_id = $this->request->getPost('member_login_name');
         // Type Error Chack 5 Time 
        $this->session->set('tokenpush',$member_id);
        
        $member_name = $this->session->tokenpush;
        $chack_user2 = new CoreMember();
        $chack_user2 = $chack_user2::findByMemberLoginName($member_name);
        
        if (count($chack_user2) != 0) {
        
          $core2 =new CoreMember();      
          $core2 =  CoreMember::findFirstByMemberLoginName($this->request->getPost('member_login_name'));
          //var_dump($core2);exit;
          $core2 = $core2->timeflag;
           $timestamp = (date("Y-m-d j:i:s")); 
          if ($core2 >= $timestamp){
           $this->view->errorMsg = "You've Login To Next. 30 Minutes"; 
            // Push Into Database Mamber Log
            $this->response->redirect('auth/index/failer');
            //session_destroy();
            }
            elseif($core2 <= $timestamp) {
                 
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
    
          }
          elseif(count($chack_user2) == 0){
             
              $this->response->redirect('auth/index/failer'); 
          }
        }
        
         else {
           
           $this->response->redirect('auth/index/failer');
        }
       // When user's login succeed , move to dashboad
        }
         
      
     }
    
    
}
