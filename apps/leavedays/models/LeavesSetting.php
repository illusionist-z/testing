<?php

namespace salts\Leavedays\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LeavesSetting extends \Library\Core\Models\Base {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getLeaveSetting() {
        try {
            $row = $this->modelsManager->createBuilder()
                ->columns('max_leavedays,fine_amount')
                ->from('salts\Leavedays\Models\LeavesSetting')
                ->getQuery()
                ->execute();
             return $row;
        } catch (Exception $ex) {
            echo $ex;
        }
        
    }

    public function editLeaveSetting($max_leavedays) {
        try {
            $sql = "Update leaves_setting SET max_leavedays ='" . $max_leavedays . "' ";
            $this->db->query($sql);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

}
