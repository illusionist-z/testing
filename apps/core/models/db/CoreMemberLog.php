<?php

namespace salts\Core\Models\Db;

use Phalcon\Mvc\Model;
/**
 * @author Yan Lin Pai<wizardrider@gmail.com>
 * 
 *
 * 
 **/

class CoreMemberLog extends Model {
    public function initialize() {
        parent::onConstruct();
    }
    public $token;
    public $member_id;
    public $ip_address;
    public $mac;

}
