<?php

namespace salts\Core\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CorePermissionGroup extends \Library\Core\Models\Base {

    // Use trait for singleton
    use \Library\Core\Models\SingletonTrait;

    public $permission_code;
    public $page_rule_group;
    public $permission_group_code;
    public $permission_group_name;

}
