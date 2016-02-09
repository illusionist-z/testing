<?php

namespace salts\Notification\Models;

class CoreNotification extends \Phalcon\Mvc\Model {

    public $noti_id;
    public $member_id;

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getNotiInfo($Noti_id) {
            
     
        try {
            $row = $this->modelsManager->createBuilder()
                    ->columns(array('core.*', 'leaves.*'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->join('salts\Notification\Models\Leaves', 'core.member_id = leaves.member_id', 'leaves')
                    ->Where('leaves.noti_id = :Noti_id:', array('Noti_id' => $Noti_id))
                    ->getQuery()
                    ->execute();
        } catch (\PDOException $e) {
            throw $e;
        }

        return $row;
    }

}
