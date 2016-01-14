<?php

namespace salts\Managecompany\Models;
use Phalcon\Mvc\Model;

class CompanyTbl extends \Library\Core\BaseModel {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    /**
     * 
     * @param type $data
     * @param type $check
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Add New Company to company_tbl table
     */
    public function addnew($data, $check) {

        $date = date("Y-m-d H:i:s");
        $sdate = date("Y-m-d", strtotime($data['sdate']));
        
        $sql = "INSERT INTO `company_tbl`(`company_id`, `company_name`, `email`, `phone_no`, "
                . "`db_name`, `user_name`, `db_psw`, `host`, `user_limit`, `starting_date`, "
                . "`created_dt`) VALUES "
                . "('" . $data['id'] . "','" . $data['name'] . "','" . $data['email'] . "','" . $data['phno'] . "'"
                . ",'" . $data['db'] . "','" . $data['dbun'] . "','" . $data['dbpsw'] . "','" . $data['host'] . "',"
                . "'" . $data['limit'] . "','" . $sdate . "','" . $date . "')";
        $this->db->query($sql);
        for ($i = 0; $i < count($check); $i++) {
            $sql = "INSERT INTO `enable_module`(`company_id`, `module_id`) VALUES ('" . $data['id'] . "','" . $check[$i] . "')";
            $this->db->query($sql);
        }
    }

    public function getallcom() {
        $result = $this->db->query("select * from company_tbl where deleted_flag=0");

        $final_result = $result->fetchall();
        $i = 0;
//        foreach ($final_result as $value) {
//            $result = $this->db->query("select module_id from enable_module where company_id='" . $value['company_id'] . "' ");
//            $module = $result->fetchall();
//            $final_result[$i]['module'] = "aa";
//            $i++;
//        }
        return $final_result;
    }
    
    

    public function findDatabyId($id) {
        $result = $this->db->query("select * from company_tbl where company_tbl.company_id='" . $id . "' ");

        $final_result = $result->fetchArray();
        return $final_result;
    }
    
       public function findCombyId($id) {
        $result = $this->db->query("select * from company_tbl where company_tbl.company_id='" . $id . "' ");

        $final_result = $result->fetchall();
        return $final_result;
    }

    public function findModulebyId($id) {
        $result = $this->db->query("select module_id from enable_module where enable_module.company_id='" . $id . "' ");

        $final_result = $result->fetchAll();
        return $final_result;
    }

    public function updatecom($com, $check) {
        $date = date("Y-m-d H:i:s");
        $sdate = date("Y-m-d", strtotime($com['sdate']));

        $sql = "UPDATE company_tbl set company_name= '" . $com['name'] . "' , email= '" . $com['email'] . "',"
                . "phone_no= '" . $com['phno'] . "',db_name= '" . $com['db'] . "' ,user_name= '" . $com['dbun'] . "',"
                . " db_psw= '" . $com['dbpsw'] . "',host= '" . $com['host'] . "',"
                . "user_limit= '" . $com['limit'] . "',starting_date= '" . $sdate . "',"
                . "updated_dt= '" . $date . "' where company_tbl.company_id= '" . $com['id'] . "'  ";
        $this->db->query($sql);
        $this->db->query("delete  from enable_module where enable_module.company_id='" . $com['id'] . "' ");
        for ($i = 0; $i < count($check); $i++) {
            $sql = "INSERT INTO `enable_module`(`company_id`, `module_id`) VALUES ('" . $com['id'] . "','" . $check[$i] . "')";
            $this->db->query($sql);
        }
    }
    
    public function deleteCompanyById($id)
    {
        $sql="UPDATE `company_tbl` SET `deleted_flag`=1 WHERE `company_id` = '" . $id . "' ";
        $this->db->query($sql);
    }
}
