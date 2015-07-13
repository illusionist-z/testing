<?php

namespace workManagiment\Auth\Models;

use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault;
use workManagiment\Auth\Models\Db\CoreMember;
use workManagiment\Auth\Models\Db\AuthFailedLogins;

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
        $user = $this->db->query("SELECT * FROM core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user = $user->fetchArray();

        return $user;
//        if ($user == false) {
//            $this->failedLogin(0);
//            return false;
//        }
//
//        // Check the password
//        if (!$this->security->checkHash($loginParams['password'], $user->password)) {
//            $this->failedLogin($user->member_login_name);
//            return false;
//        }
//
//        $this->_setUserInfo($user);
//        return TRUE;
//        // Check if the user was flagged
//        $this->checkUserFlags($user);
//
//        // Register the successful login
//        $this->saveSuccessLogin($user);
//
//        // Check if the remember me was selected
//        if (isset($loginParams['remember'])) {
//            $this->createRememberEnviroment($user);
//        }
//
//        $this->session->set('auth-identity', array(
//            'id' => $user->id,
//            'name' => $user->name,
//            'profile' => $user->profile->name
//        ));
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
