<?php namespace Crm\Core\Models\Biz;

/**
 * Description of LockRecord
 *
 * @author copei
 */
use Crm\Core\Models\Db,
    Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;

class LockRecord extends \Phalcon\Mvc\Model{
    
    public $_transaction;


    /**
     * Start to lock the record by uuid
     * @param string $uuid
     * @param int $lifeTime per seconds
     * @return type
     * @throws \Crm\Core\Models\biz\Exception
     */
    public function start($uuid,$lifeTime = 3600){
        try{
            $userInfo = $this->getDI()->getShared('session')->get('user');
            
            $expire_dt = date("Y-m-d H:i:s", strtotime("+{$lifeTime} seconds"));
            //1 checks uuid whether exist or not. 
            $selectLock = new Db\CoreLockRecord();
            
            $lockRec = $selectLock->query()
                                  ->where('uuid = :uuid:',['uuid'=>$uuid])
                                  ->execute()
                                  ->getFirst();
            
            //2 checks date expired
            if(!$this->isLockFile($lockRec,$userInfo)){
                return FALSE;
            }
            
            //3 create lock record
            $newLockRec = new Db\CoreLockRecord();
            $newLockRec->uuid = $uuid;
            $newLockRec->user_id = $userInfo['id'];
            $newLockRec->user_name = $userInfo['name'];
            $newLockRec->expire_dt = $expire_dt;
            $newLockRec->create();
            
        }catch(Phalcon\Exception $e){
            throw $e;
        }
        return TRUE;
    }
    
    /**
     * 
     * @param type $lockRec
     * @param type $userInfo
     * @param boolean $isDelete
     * @return boolean
     */
    public function isLockFile($lockRec,$userInfo){
        
        try{
            if($lockRec == null){
                return TRUE;
            }

            $now = date("Y-m-d H:i:s");
            if($now > $lockRec->expire_dt){
                $lockRec->delete();
                return TRUE;
            }

            if($lockRec->user_id == $userInfo['id']){
                $lockRec->delete();
                return TRUE;
            }
            
        }  catch (Phalcon\Exception $e){
            throw $e;
        }
        return FALSE;
    }
}
