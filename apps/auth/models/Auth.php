<?php namespace Crm\Auth\Models;

use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault;
use Crm\Auth\Models\Db\Users;
use Crm\Auth\Models\Db\AuthFailedLogins;
use Crm\Auth\Models;

class Auth extends Component{
    /**
     * Checks the user credentials
     *
     * @param array $loginParams
     * @return boolan
     */
    public function check($loginParams,& $user = null)
    {
        // Check if the user exist
        $user = Users::findFirstByAccount($loginParams['account']);
        if ($user == false) {
            $this->failedLogin(0);
            return false;
        }

        // Check the password
        if (!$this->security->checkHash($loginParams['password'], $user->password)) {
            $this->failedLogin($user->account);
            return false;
        }
        
        return TRUE;
        
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
    public function failedLogin($userId)
    {
        try{
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
        }catch(\Exception $e){
            $di = FactoryDefault::getDefault();
            $di->getShared('logger')->WriteException($e);
        }
    }
}