<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
class SearchController extends ControllerBase
{
    
    public function initialize() {
       
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->setCommonJsAndCss();
        
    }

    public function indexAction() {
        $Salarydetail=new SalaryDetail();
        $cond = $this->request->get('cond', array());
        //print_r($cond);exit;
        $search_result=$Salarydetail->seacrhsalary($cond);
        //print_r($search_result);exit;
        $this->view->disable();
        echo json_encode($search_result);
    }
}

