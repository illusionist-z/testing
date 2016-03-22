<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginForAll
 *
 * @author Su Zin Kyaw <gnext.suzin@gmail.com>
 */
//require_once 'apps/auth/controllers/LoginControllerTest.php';
use Phalcon\Filter;
use salts\Auth\Models;
use salts\Auth\Controllers;
use salts\Core\Models\Db\CoreMember;



class LoginForAll extends Controllers\LoginController {

    //put your code here
    public $login_params = array('company_id' => 'gnext', "member_login_name" => "admin", "password" => "admin");

    public function loginFirst() {
        $filter = new Filter();

        $ModelAuth = new Models\Auth();
        // TODO: この下の式が正しいのかをチェック [Kohei Iwasa]

        $companyDB = $ModelAuth->findCompDb($this->login_params);
        // Data Base Hase
        if ($companyDB) {
            // User Chack    
            $this->session->set('db_config', $companyDB);
            // Module Chack
            $module = new Models\Auth();
            $module_id = $this->session->db_config['company_id'];
            $company_module = $module->findModule($module_id);
            $this->session->set('module', $company_module);
            $result = $ModelAuth->check($this->login_params, $user);
            $permission = $ModelAuth->getPermit($this->login_params);
            $Member = new \salts\Core\Models\Db\CoreMember();
            $ll = $Member::getInstance();
            $lang = $Member->getLang($this->login_params);
            $this->session->set('language', $lang['lang']);
            $Member->updateContract($this->login_params);
            $this->session->set('page_rule_group', $permission);
            $user = array();
            $this->session->set('user', $result);
            date_default_timezone_set('Asia/Rangoon');
            $timestamp = date("Y-m-d H:i:s");
            // Type Error Chack 5 Time 
            $member_id = $filter->sanitize($this->request->getPost('member_login_name'), 'string');
            $this->session->set('tokenpush', $member_id);
            $member_name = $this->login_params['member_login_name'];
            $chack_user2 = new CoreMember();
            $chack_user2 = CoreMember::findByMemberLoginName($member_name);
            if (0 !== count($chack_user2)) {
                $core2 = new CoreMember();
                $core2 = $chack_user2[0]->timeflag;

                $timestamp = (date("Y-m-d H:i:s"));
                if ($core2 <= $timestamp) {
                    if ($result) {
                        $ModelPermission = new Models\Permission();
                        $permissions = [];
                        //Set user's permission to session 
                        $Permission = $ModelPermission->get($result, $permissions, $lang['lang']);
                        $this->session->set('auth', $Permission);
                        $this->response->redirect('home');
                    }
                }
            }
        }
    }

}
