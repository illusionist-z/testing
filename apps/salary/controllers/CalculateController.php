<?php

namespace workManagiment\Salary\Controllers;

use workManagiment\Core\Models\Db;
use workManagiment\Salary\Models\SalaryDetail;
use workManagiment\Salary\Models\SalaryMaster;
class CalculateController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->config = \Module_Config::getModuleConfig('salary');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->setCommonJsAndCss();
        
    }

    /**
     * calculation of salary and tax
     */
    public function indexAction(){
     //echo $this->config->salary;exit;
     $Salarydetail=new SalaryDetail();
     $Salarymaster=new SalaryMaster();
     $getbasic_salary=$Salarymaster->getbasicsalary();
     //print_r($getbasic_salary);echo "<br><br>";
     //calculate overtime by attendances and salary master
     $overtime=$Salarymaster->calculate_overtime();
     
    //insert overtime and salary information to salary detail
    $Salarydetail->insert_salarydetail($overtime);
    
    //calculate the basic salary
    $tax=$Salarymaster->calculate_tax_salary($getbasic_salary);
    //print_r($tax);exit;
    //insert taxs of all staff to salary detail
    $Salarydetail->insert_taxs($tax);
    
    //calculate ssc fee of employee and employer
    $ssc=$Salarymaster->sscforCompandEmp();
    //print_r($ssc);exit;
    //insert ssc of all staffs to salary detail
    $Salarydetail->insert_ssc($ssc);
    
    echo "<script>alert('complete calculation of salary');</script>";
    $this->response->redirect('salary/index/monthlysalary');
    }
}

