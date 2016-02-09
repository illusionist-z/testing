<?php

namespace salts\Setting\Models;

use Phalcon\Mvc\Model;

/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */
class CorePermissionGroup extends Model {

    public function initialize() {
        $this->db = $this->getDI()->getShared('db');
    }

    public $idpage;
    public $page_rule_group;
    public $permission_code;

}
