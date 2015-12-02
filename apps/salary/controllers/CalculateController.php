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
        //$this->assets->addCss('common/css/style.css');
        $this->assets->addJs('apps/salary/js/salary.js');
        $this->setCommonJsAndCss();
        
    }

    /**
     * calculation of salary and tax
     */
    public function indexAction(){
    $salary_start_date=$this->request->get('salary_date');
    
    $basic_salary_ssc=$this->config->salary['basic_salary_ssc'];
    $deduce=$this->config->salary['deduce'];
    $overrate=$this->config->salary['overrate'];
     
    $Salarydetail=new SalaryDetail();
    $Salarymaster=new SalaryMaster();
    $getbasic_salary=$Salarymaster->getbasicsalary();
    //print_r($getbasic_salary);exit;
    //calculate overtime by attendances and salary master
    //$overtime=$Salarymaster->calculate_overtime();
     
   // $getcomp_startdate=$Salarydetail->getComp_startdate();
    $creator_id=$this->session->user['member_id'];
    //calculate the basic salary
    $tax=$Salarymaster->calculate_tax_salary($getbasic_salary,$salary_start_date,$creator_id);
   
    //insert taxs of all staff to salary detail
    $Salarydetail->insert_taxs($tax);
    
    //print_r($overtime);exit;
    //insert overtime and salary information to salary detail
    //$Salarydetail->insert_salarydetail($overtime,$salary_start_date);
    $Salarymaster->saveBudgetendyr_data($salary_start_date);
    
    //calculate ssc fee of employee and employer
    $ssc=$Salarymaster->sscforCompandEmp();
    //print_r($ssc);exit;
    //insert ssc of all staffs to salary detail
    $Salarydetail->insert_ssc($ssc);
    
   
    $this->response->redirect('salary/index/monthlysalary');
    }
}

