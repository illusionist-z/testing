<?php
namespace salts\Auth\Controllers;
use salts\Auth\Models;
use salts\Auth\Models\Permission;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db\CompanyTbl ;
use salts\Core\Models\Db\UserTbl;
use salts\Core\Models\Db\EnableModule;
use Phalcon\Filter;
class LoginController extends ControllerBase {
    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
    }

    /**
     * Index Action
     */
    public function indexAction() {
        $filter = new Filter();
        $login_params = $this->request->get();
      
        $ModelAuth = new Models\Auth();
        // TODO: この下の式が正しいのかをチェック [Kohei Iwasa]
        if (!isset($login_params['company_id'])) {
            $dbinfo['host'] = 'localhost';
            $dbinfo['db_name'] = 'company_db';
            $dbinfo['user_name'] = 'root';
            $dbinfo['db_psw'] = 'root';
            $this->session->set('db_config', $dbinfo);
            //$result = $ModelAuth->Check($login_params, $user);
            
         /*
         *  
         * @Varsion Yan Lin Pai <wizardrider@gmail.com>
         * LoginController Change simple SQL function To -> Phalcon SQL Type
         */
            
            $filter = new Filter();
            $name = $filter->sanitize($login_params['member_login_name'], "string");
            $password = $login_params['password'];
            $database = $_SESSION['db_config'];
            
            if ($database['db_name'] == 'company_db') {
                
                $user = Models\UserTbl::findLoginName($login_params, $user);
                
                } 
                
           else {
               
                 $user = Models\CoreMember::findMemberLoginName($login_params, $user);
           
                }
             
            $this->session->set('user', $result);
            // Data Base Chack
            if ($result) {
                $this->response->redirect('managecompany');
            } else {
                $this->response->redirect('auth/index/failersuperuser');
            }
        } else {
            $this->view->test = $login_params;
            $companyDB = new \salts\Core\Models\CompanyTbl();
             
           // $companyDB = $companyDB::findByCompanyId($login_params['company_id']);
          $companyDB = $companyDB::findFirst("id = 1");
           print_r(get_class_methods($companyDB));
           var_dump($companyDB);
              exit();
            // Data Base Hase
            if ($companyDB) {
                 
                // User Chack    
                $this->session->set('db_config', $companyDB);
                // Module Chack
                $module = new Models\Auth();
                $module_id = $this->session->db_config['company_id'];
                
                $company_module = \salts\Core\Models\EnableModule::findByCompanyId($module_id);
              // $company_module = $module->findModule($module_id);
                $this->session->set('module', $company_module);
                $result = $ModelAuth->check($login_params, $user);
                
            //LoginController Change simple SQL function To -> Phalcon SQL Type
            
                $permission = $ModelAuth->getPermit($login_params);
                $Member = new CoreMember();
                $ll = $Member::getInstance();
                $lang = $Member->getLang($login_params);
                $this->session->set('language', $lang['lang']);
                $Member->updateContract($login_params);
                $this->session->set('page_rule_group', $permission);
                $user = array();
                $this->session->set('user', $result);
                
                
                $timestamp = date("Y-m-d H:i:s");
                // Type Error Chack 5 Time 
                $member_id = $filter->sanitize($this->request->getPost('member_login_name'), 'string');
                $this->session->set('tokenpush', $member_id);
                $member_name = $this->session->tokenpush;
                $chack_user2 = new CoreMember();
                $chack_user2 = $Member::findByMemberLoginName($member_name);
                if (0 != count($chack_user2)) {
                    $core2 = new CoreMember();
                    $core2 = $chack_user2[0]->timeflag;
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
                            
                                 
                        $user_ip = $filter->sanitize($this->request->getPost('local'),'string');
                        $user_ip_public = $filter->sanitize($this->request->getPost('public'),'string');
                        $member_id = $filter->sanitize($this->request->getPost('member_login_name'),'string');
                        $core_member_log = new \salts\Core\Models\Db\CoreMemberLog();
                        $core_member_log->token = '';
                        $core_member_log->member_id = $member_id;
                        $core_member_log->ip_address = $user_ip;
                        $core_member_log->mac = $user_ip_public;
                        $core_member_log->save();
                            
                            $this->response->redirect('auth/index/failer');
                        }
                    }
                } elseif (0 == count($chack_user2)) {
                    $this->response->redirect('auth/index/failer');
                }
            } else {
                
                        $user_ip = $filter->sanitize($this->request->getPost('local'),'string');
                        $user_ip_public = $filter->sanitize($this->request->getPost('public'),'string');
                        $member_id = $filter->sanitize($this->request->getPost('member_login_name'),'string');
                        $core_member_log = new \salts\Core\Models\Db\CoreMemberLog();
                        $core_member_log->token = '';
                        $core_member_log->member_id = $member_id;
                        $core_member_log->ip_address = $user_ip;
                        $core_member_log->mac = $user_ip_public;
                        $core_member_log->save();
                
                $this->response->redirect('auth/index/failer');
            }
            // When user's login succeed , move to dashboad
        }
    }
}