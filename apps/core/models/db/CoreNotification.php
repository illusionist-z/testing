<?php

namespace salts\Core\Models\Db;

use Phalcon\Mvc\Model;

/**
 * @author Yan Lin Pai <> <wizardrider@gmail.com> 
 */

class CoreNotification extends Model {
    
    public $noti_creator_id;
    public $creator_name;
    public $module_name;
    public $noti_id;
    public $noti_status;
    
}
