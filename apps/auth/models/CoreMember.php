<?php

namespace salts\Auth\Models;

use Phalcon\Mvc\Model;

/**
 * @author Saw Zin Min Tun <> <sawzinminmin@gmail.com> 
 */
class CoreMember extends Model {

    public $member_id;
    public $user_rule_member_id;
    public $member_login_name;
    public $full_name;
    public $member_dept_name;
    public $member_mobile_tel;
    public $member_mail;
    public $position;
    public $user_rule;
    public $lang;
    public $member_address;
    public $member_profille;
    public $rank_code;
    public $member_is_change;
    public $working_start_dt;
    public $working_year_by_year;
    public $rs_status;
    public $timeflag;
    public $creator_id;
    public $created_dt;
    public $updater_id;
    public $updated_dt;
    public $deleted_flag;
    
    
        //for auto complete function
    public function autoUsername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("Select * from core_member where deleted_flag=0");
        $getname = $user_name->fetchall();
        return $getname;
    }

}
