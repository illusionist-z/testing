<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
class CalculateController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
     $Salarymaster=new SalaryMaster();
     $getbasic_salary=$Salarymaster->getbasicsalary();
     //calculate the basic salary
     $result=$Salarymaster->calculate_salary($getbasic_salary);
    }
}

