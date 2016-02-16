<?php

namespace salts\Salary\Controllers;

use salts\Core\Models\Db;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;
use salts\Attendancelist\Models\Attendances;

class CalculateController extends ControllerBase {

    public function initialize() {
        parent::initialize();
       // $this->config = \Module_Config::getModuleConfig('salary');
        $this->assets->addJs('apps/salary/js/base.js');
        $this->setCommonJsAndCss();
    }

    /**
     * calculation of salary and tax
     */
    public function indexAction() {
        $salary_start_date = $this->request->get('salary_date');
      //  $basic_salary_ssc = $this->config->salary['basic_salary_ssc'];
     //   $deduce = $this->config->salary['deduce'];
     //   $overrate = $this->config->salary['overrate'];
        $SalaryDetail = new SalaryDetail();
        $Salarymaster = new SalaryMaster();
        $Attendance = new \salts\Salary\Models\Attendances();
        $countattday = $Attendance->getCountattday($salary_start_date);

        $getbasic_salary = $Salarymaster->getBasicsalary($countattday);
        //calculate overtime by attendances and salary master
        // $getcomp_startdate=$SalaryDetail->getCompStartdate();
        $creator_id = $this->session->user['member_id'];
        //calculate the basic salary
        $tax = $Salarymaster->calculateTaxSalary($getbasic_salary, $salary_start_date, $creator_id);

        //insert taxs of all staff to salary detail
        $SalaryDetail->insertTaxs($tax);

        //insert overtime and salary information to salary detail
        //calculate ssc fee of employee and employer
        $ssc = $Salarymaster->sscforCompandEmp();

        //insert ssc of all staffs to salary detail
        $SalaryDetail->insertSsc($ssc);

        $this->response->redirect('salary/index/monthlysalary');
    }

}
