<?php namespace Crm\User\Models\Biz;

/**
 * Description of User
 *
 * @author Kohei Iwasa
 */

use Crm\User,
    Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class Users extends \Phalcon\Mvc\Model{
    //put your code here
    
    public function update($id , $parms){
        
        $userInfo = $this->getDI()->getShared('session')->get('user');
        
        try{
            $transactionManager = new TransactionManager();
            $transaction = $transactionManager->get();
            
            $user = new User\Models\Db\Users();
            
            $parms['update_id'] = $userInfo['id'];
            $parms['update_dt'] = date("Y-m-d H:i:s");
        
            $userObj = $user->findFirstById($id);
            $userObj->save($parms);
        }  catch (\Phalcon\Exception $e){
            throw $e;
        }
    }
}
