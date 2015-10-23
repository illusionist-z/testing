<?php namespace workManagiment\Auth\Models\Db;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CorePermission extends \Library\Core\BaseModel{               
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
    public function moduleLang ($code,$lang) {
        $this->db = $this->getDI()->getShared("db");
        $lang = (null === $lang ? 'en' : $lang);          //set default lang to 'en' if not exist session lang
        $query = "Select permission_code,permission_name_en,permission_name_$lang from core_permission where permission_code ='$code'";
        $data = $this->db->query($query);
        $result = $data->fetchall();
        return $result;
    }
}
