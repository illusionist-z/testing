<?php

namespace salts\Salary\Controllers;

use salts\Core\Models\Db;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;
class SearchController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
        
    }

    public function indexAction() {
        $Salarydetail=new SalaryDetail();
        $cond = $this->request->get('cond', array());
        $search_result=$Salarydetail->seacrhsalary($cond);
        //print_r($search_result);exit;
        $this->view->disable();
        echo json_encode($search_result);
    }
}

