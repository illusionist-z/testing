<?php

namespace salts\Document\Models;
use Phalcon\Filter;

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
    public function editCompanyInfo($update_info) {
        $filter = new Filter();
        $ComInfo = CompanyInfo::findFirst('id =1');
        $ComInfo->company_name = $filter->sanitize($update_info['company_name'], "string");
        $ComInfo->company_logo = $filter->sanitize($update_info['company_logo'], "string");
        $ComInfo->company_address = $filter->sanitize($update_info['company_address'], "string");
        $ComInfo->company_phno =$filter->sanitize($update_info['company_phno'], "string");
        $ComInfo->update();
    }

}
