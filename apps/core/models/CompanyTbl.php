<?php

namespace salts\Core\Models;

use Phalcon\Mvc\Model;

/**
 * @author Yan Lin Pai <> <wizardrider@gmail.com> 
 */
class CompanyTbl extends Model {

    public $conpany_id;
    public $company_name;
    public $email;
    public $phone_no;
    public $db_name;
    public $user_name;
    public $db_psw;
    public $host;
    public $user_limit;
    public $starting_date;
    public $creator_id;
    public $created_dt;
    public $updater_id;
    public $updated_id;
    public $deleted_flag;
    public $id;
}
    