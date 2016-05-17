<?php

namespace salts\Setting\Models;

use Phalcon\Mvc\Model; 
/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */
class CorePermissionGroup extends Model {

    public $idpage;
    public $page_rule_group;
    public $permission_code;
    public $permission_group_code;  
    public $permission_group_name;


}
