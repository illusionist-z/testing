<?php

namespace salts\Document\Models;
class CompanyInfo extends \Phalcon\Mvc\Model {
      public $company_name;
      public $company_phno;
      public  $id;

    /**
     * 
     * @param type $data
     * Update Company Info
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editCompanyInfo($data,$file_contents) {
        $this->db = $this->getDI()->getShared("db");
        if($file_contents==NULL){
                $sql = "UPDATE company_info SET"
                . " company_name='" . $data['company_name'] . "',"
                . "company_address='" . $data['company_address'] . "',"
                . "company_phno='" . $data['company_phno'] . "' WHERE 1";
       }
        else{
                $sql = "UPDATE company_info SET"
                . " company_name='" . $data['company_name'] . "',"
                . "company_logo='" . $file_contents . "',"
                . "company_address='" . $data['company_address'] . "',"
                . "company_phno='" . $data['company_phno'] . "' WHERE 1";
        }
        $this->db->query($sql);
    }

}
