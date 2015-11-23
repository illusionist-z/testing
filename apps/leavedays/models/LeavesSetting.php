<?php

namespace workManagiment\Leavedays\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LeavesSetting extends \Library\Core\BaseModel {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function getleavesetting() {
        $row = $this->modelsManager->createBuilder()
                ->columns('max_leavedays,fine_amount')
                ->from('workManagiment\Leavedays\Models\LeavesSetting')
                ->getQuery()
                ->execute();

        return $row;
    }

    public function editleavesetting($max_leavedays, $fine_amount) {
        try {
            $sql = "Update leaves_setting SET max_leavedays ='" . $max_leavedays . "',fine_amount ='" . $fine_amount . "' ";
            $this->db->query($sql);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

}
