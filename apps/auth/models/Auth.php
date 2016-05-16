<?php

namespace salts\Auth\Models;

use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault;
use salts\Auth\Models\Db\AuthFailedLogins;
use Phalcon\Filter;

class Auth extends Component {   
    
    public function initialize() {
        $this->filter = new Filter();
        $this->db = $this->getDI()->getShared("db");
        $this->login_db = $this->getDI()->getShared("login_db");
    }

    /**
     * Find company_db
     * @param type $param
     * @return type
     */
    public function findCompDb($param) {    

        try {
            $cop_id = $this->filter->sanitize($param['company_id'], "string");
            $sql = "SELECT * FROM company_tbl where company_id='" . $cop_id . "' and deleted_flag=0";
            $rs = $this->getDI()->getShared("login_db")
                    ->query($sql, array($cop_id));
            $rs = $this->login_db->query($sql);

            $row = $rs->fetchArray();
        } catch (\Exception $e) {
            $di = FactoryDefault::getDefault();
            $di->getShared('logger')->WriteException($e);
        }
        //print_r($row);exit;
        return $row;
    }

    public function findModule($company_module) {
        $cop_module = $this->filter->sanitize($company_module, "string");
        $sql = "SELECT * FROM enable_module where company_id='" . $cop_module . "' ";
        $Result_sql = $this->login_db->query($sql);
        $Result = $Result_sql->fetchAll();
        return $Result;
    }

    public function getProfile($id) {
        $this->db = $this->getDI()->getShared("db");
        $this->filter->sanitize($id, "string");
        $user_sql = $this->db->query("SELECT * FROM core_member_profile WHERE member_id='" . $id . "'");
        $user = $user_sql->fetchArray();
        return $user;
    }

    /**
     * Checks the user credentials
     *
     * @param array $loginParams
     * @return boolan
     */
    public function Check($loginParams, & $user = null) {        
        $name = $this->filter->sanitize($loginParams['member_login_name'], "string");
        $password = $loginParams['password'];
        $database = $_SESSION['db_config'];
        if ($database['db_name'] == 'salts_company') {
            $sql = "SELECT * FROM user_tbl where login_name='" . $name . "' and password='" . sha1($password) . "' and deleted_flag=0";
        } else {
            $sql = "SELECT * FROM core_member where member_login_name= '" . $name . "' and member_password='" . sha1($password) . "' and deleted_flag=0";
        }
        $user_sql = $this->db->query($sql);
        $user = $user_sql->fetchArray();
        return $user;
    }

    public function getPermit($loginParams) {
        $name = $this->filter->sanitize($loginParams['member_login_name'], "string");
        $password = $loginParams['password'];
        $this->db = $this->getDI()->getShared("db");

        $user_sql = $this->db->query("SELECT * FROM core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user = $user_sql->fetchArray();

        $permission = $this->db->query("SELECT permission_group_id_user FROM core_permission_rel_member where rel_member_id='" . $user['member_id'] . "' ");
        $permission_name = $permission->fetchArray();
        return $permission_name['permission_group_id_user'];
    }

    /**
     * Implements login throttling
     * Reduces the efectiveness of brute force attacks
     *
     * @param int $userId
     */
    public function failedLogin($userId) {
        try {
            $failedLogin = new AuthFailedLogins();
            $failedLogin->user_uuid = $userId;
            $failedLogin->ip_address = $this->request->getClientAddress();
            $failedLogin->attempted = time();
            $failedLogin->save();
            $attempts = AuthFailedLogins::count(array(
                        'ip_address = ?0 AND attempted >= ?1',
                        'bind' => array(
                            $this->request->getClientAddress(),
                            time() - 3600 * 6
                        )
            ));

            switch ($attempts) {
                case 1:
                case 2:
                    // no delay
                    break;
                case 3:
                case 4:
                    sleep(2);
                    break;
                default:
                    sleep(4);
                    break;
            }
        } catch (\Exception $e) {
            $di = FactoryDefault::getDefault();
            $di->getShared('logger')->WriteException($e);
        }
    }

    /**
     * 
     * @param type $userObject
     */
    private function _setUserInfo($userObject) {
        $user = [
            'id' => $userObject->id,
            'name' => $userObject->name,
            'kana' => $userObject->kana,
            'dept_code' => $userObject->dept_code,
            'dept_name' => $userObject->dept_name,
            'lang' => $userObject->lang,
            'email01' => $userObject->email01,
            'rank_code' => $userObject->rank_code,
        ];
        $this->session->set('user', $user);
    }

}
