<?php

namespace salts\Auth\Models;

use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault;
use salts\Auth\Models\Db\AuthFailedLogins;
use Phalcon\Filter;

class Auth extends Component {

    public function initialize() {
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
            $sql = "SELECT * FROM company_tbl where company_id='".$param['company_id']."' and deleted_flag=0";
            
//            $rs = $this->getDI()->getShared("login_db")
//                    ->query($sql, array($param['company_id']));
            $rs=$this->login_db->query($sql);
            
            $row = $rs->fetchArray();
        } catch (\Exception $e) {
            $di = FactoryDefault::getDefault();
            $di->getShared('logger')->WriteException($e);
        }
        //print_r($row);exit;
        return $row;
    }
    
    public function findModule($company_module) {
        $sql = "SELECT * FROM enable_module where company_id='" . $company_module . "' ";
        $Result = $this->login_db->query($sql);
        $Result = $Result->fetchAll();
        return $Result;
    }

    /**
     * Checks the user credentials
     *
     * @param array $loginParams
     * @return boolan
     */
    public function Check($loginParams, & $user = null) {
        $filter = new Filter();
        $name = $filter->sanitize($loginParams['member_login_name'], "string");
        $password = $loginParams['password'];
        $database = $_SESSION['db_config'];
        if ($database['db_name'] == 'company_db') {
            $sql = "SELECT * FROM user_tbl where login_name='" . $name . "' and password='" . sha1($password) . "' and deleted_flag=0";
        } else {
            $sql = "SELECT * FROM core_member where member_login_name= '" . $name . "' and member_password='" . sha1($password) . "' and deleted_flag=0";
        }
        $user = $this->db->query($sql);
        $user = $user->fetchArray();
        return $user;
    }

    public function getPermit($loginParams) {
        $filter = new Filter();
        $name = $filter->sanitize($loginParams['member_login_name'], "string");
        $password = $loginParams['password'];
        $this->db = $this->getDI()->getShared("db");

        $user = $this->db->query("SELECT * FROM core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user = $user->fetchArray();
        
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
