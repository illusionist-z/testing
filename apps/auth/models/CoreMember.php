<?php

namespace salts\Auth\Models;

use Phalcon\Mvc\Model;

/**
 * @author Saw Zin Min Tun <> <sawzinminmin@gmail.com> 
 */
class CoreMember extends Model {

    public $member_mail;
    public $member_login_name;
    public $member_password;
    public $full_name;
    public $member_dept_name;
    public $timeflag;
    public $lang;
    }
