<?php

namespace salts\Auth\Models;

use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault;
use salts\Auth\Models\Db\CoreMember;
use salts\Auth\Models\Db\AuthFailedLogins;

class Auth extends Component {

    /**
     * Checks the user credentials
     *
     * @param array $loginParams
     * @return boolan
     */
    public function check($loginParams, & $user = null) {
      
        // Check if the user exist
        $name = $loginParams['member_login_name'];
        $password = $loginParams['password'];
        $this->db = $this->getDI()->getShared("db");
      
        $user = $this->db->query("SELECT * FROM core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "' and deleted_flag=0");
        $user = $user->fetchArray();
        
        
        return $user;

    }
    
     public function getpermit($loginParams) {
      
        
        $name = $loginParams['member_login_name'];
        $password = $loginParams['password'];
        $this->db = $this->getDI()->getShared("db");
      
        $user = $this->db->query("SELECT * FROM core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user = $user->fetchArray();
        
        $permission = $this->db->query("SELECT permission_group_id_user FROM core_permission_rel_member where rel_member_id='" . $user['member_id'] . "' ");
        $permission_name = $permission->fetchArray();
      // var_dump($permission_name);exit;
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
