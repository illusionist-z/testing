<?php

namespace salts\Document\Models;

class CompanyInfo extends \Phalcon\Mvc\Model {
      public $company_name;
      public $company_phno;
      public  $id;
//    public function initialize() {
//        $this->db = $this->getDI()->getShared("db");
//    }
//
//    /*
//     * Getting Information of Company 
//     * Using For LetterHead
//     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
//     */
//    public function getCompanyInfo() {
//        $sql = "SELECT * from company_info";
//        $result = $this->db->query($sql);
//        $final_result = $result->fetcharray();
//        return $final_result;
//    }
//
    /**
     * 
     * @param type $data
     * Update Company Info
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editCompanyInfo($update_info) {
          if ($_FILES["fileToUpload"]["name"] == null) {
            $update_info['company_logo'] = $update_info['temp_logo'];
        } else {
            $update_info['company_logo'] = $file_name;
        }
        $ComInfo = CompanyInfo::findFirst('id =1');
        $ComInfo->company_name = $update_info['company_name'];
        $ComInfo->company_logo = $update_info['company_logo'];
        $ComInfo->company_address = $update_info['company_address'];
        $ComInfo->company_phno = $update_info['company_phno'];
        $ComInfo->update();
    }

}
