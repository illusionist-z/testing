<?php

namespace salts\Auth\Controllers;

use salts\Core\Models\Db;
use salts\Auth\Models;

class LoginController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

    /**
     * Index Action
     */
    public function indexAction() {

        $login_params = $this->request->get();
        $ModelAuth = new Models\Auth();
        
        // TODO: この下の式が正しいのかをチェック [Kohei Iwasa]
        if (!isset($login_params['company_id'])) {
            $dbinfo['host'] = 'localhost';
            $dbinfo['db_name'] = 'company_db';
            $dbinfo['user_name'] = 'root';
            $dbinfo['db_psw'] = '';

            $this->session->set('db_config', $dbinfo);
            $result = $ModelAuth->check($login_params, $user);
            $this->session->set('user', $result);
            // Data Base Chack
            if ($result) {
                $this->response->redirect('managecompany');
            } else {
                $this->response->redirect('auth/index/failersuperuser');
            }
            
        } else {

            $this->view->test = $login_params;
            $companyDB = $ModelAuth->findcomp_db($login_params);
            // Data Base Hase
            if ($companyDB) {
                // User Chack    
                $this->session->set('db_config', $companyDB);

                // Module Chack
                $module = new Models\Auth();
                $module_id = $this->session->db_config['company_id'];
                $company_module = $module->find_module($module_id);
                $this->session->set('module', $company_module);

                $result = $ModelAuth->check($login_params, $user);
                $permission = $ModelAuth->getpermit($login_params);
                
                $Member = Db\CoreMember::getInstance();
//                $member = new Db\CoreMember();
                $lang = $Member->getlang($login_params);
                $this->session->set('language', $lang['lang']);
                $Member->updatecontract($login_params);
                $this->session->set('page_rule_group', $permission);
                $user = array();
                $this->session->set('user', $result);

                date_default_timezone_set('Asia/Rangoon');

                // TODO: ここのオブジェクトを分けている理由を確認 [Kohei Iwasa]
//                $core = new Db\CoreMember();
                //$tokenpush = uniqid(bin2hex(mcrypt_create_iv(18, MCRYPT_DEV_RANDOM)));
                $user_ip = $this->request->getPost('local');
                
                // TODO: 削除？ [Kohei Iwasa]
                $user_ip_public = $this->request->getPost('public');
                
                $core->token = $tokenpush;
                $member_id = $this->request->getPost('member_login_name');
                $insert = $Member->tokenpush($tokenpush, $member_id, $user_ip);

                $timestamp = date("Y-m-d H:i:s");
                // Type Error Chack 5 Time 
                $this->session->set('tokenpush', $member_id);

                $member_name = $this->session->tokenpush;
//                $chack_user2 = new Db\CoreMember();
                $chack_user2 = $Member::findByMemberLoginName($member_name);

                if (count($chack_user2) != 0) {

//                    $core2 = new Db\CoreMember();
                    $core2 = $Member::findFirstByMemberLoginName($this->request->getPost('member_login_name'));
                    //var_dump($core2);exit;
                    $core2 = $core2->timeflag;

                    $timestamp = (date("Y-m-d H:i:s"));
                    if ($core2 >= $timestamp) {
                        $this->view->errorMsg = "You've Login To Next. 30 Minutes";
                        // Push Into Database Mamber Log
                        $this->response->redirect('auth/index/failer');
                        //session_destroy();
                    } elseif ($core2 <= $timestamp) {

                        if ($result) {
                            $ModelPermission = new Models\Permission();
                            $permissions = [];
                            //Set user's permission to session 
                            $Permission = $ModelPermission->get($result, $permissions, $lang['lang']);
                            $this->session->set('auth', $Permission);
                            $this->response->redirect('home');
                            session_destroy(($_SESSION['attempts']));
                        } else {
                            $this->response->redirect('auth/index/failer');
                        }
                    }
                } elseif (count($chack_user2) == 0) {

                    $this->response->redirect('auth/index/failer');
                }
            } else {

                $this->response->redirect('auth/index/failer');
            }
            // When user's login succeed , move to dashboad
        }
    }

}
