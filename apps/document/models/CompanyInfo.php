<?php

namespace salts\Document\Models;

use Phalcon\Mvc\Model;

class CompanyInfo extends \Library\Core\BaseModel {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    /*
     * Getting Information of Company 
     * Using For LetterHead
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */

    public function GetCompanyInfo() {
        $sql = "SELECT * from company_info";
        $result = $this->db->query($sql);
        $final_result = $result->fetcharray();
        return $final_result;
    }

    /**
     * 
     * @param type $data
     * Update Company Info
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function EditCompanyInfo($data) {
        $sql = "UPDATE company_info SET"
                . " company_name='" . $data['company_name'] . "',"
                . "company_logo='" . $data['company_logo'] . "',"
                . "company_address='" . $data['company_address'] . "',"
                . "company_phno='" . $data['company_phno'] . "' WHERE 1";
        $this->db->query($sql);
    }

}
