<?php

namespace salts\Core\Models;

use Phalcon\Mvc\Model;

/**
 * @author Yan Lin Pai <> <wizardrider@gmail.com> 
 */
class UserTbl extends Model {

    public $user_id;
    public $login_name;
    public $password;
    public $creator_id;
    public $created_dt;
    public $updater_id;
    public $updated_dt;
    public $deleted_flag;
    
}
