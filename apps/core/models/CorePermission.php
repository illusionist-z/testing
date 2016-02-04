<?php

namespace salts\Core\Models;

/*
 * TODO: このファイル自体を削除予定(Coreフォルダに移動したので) [Kohei Iwasa]
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CorePermission extends \Library\Core\BaseModel {

    // Use trait for singleton
    use \Library\Core\Models\SingletonTrait;

    public function initialize() {
        parent::initialize();
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @desc   Translate language
     * @param type $permission_code
     * @param type $lang
     * @return type array
     */
    public function moduleLang($code, $lang) {
        $this->db = $this->getDI()->getShared("db");
        $query = "Select permission_code,permission_name_en,permission_name_$lang from core_permission where permission_code ='$code'";
        $data = $this->db->query($query);
        $result = $data->fetchall();
        return $result;
    }

}
