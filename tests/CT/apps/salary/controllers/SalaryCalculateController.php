<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
use salts\Salary\Controllers;
use salts\Salary\Models;

include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/salary/controllers/CalculateController.php';
require_once 'apps/core/models/db/CoreMember.php';
require_once 'library/core/Controller.php';

/**
 * Description of SalaryMasterController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class SalaryCalculateController extends Controllers\CalculateController {
    
    public $salary_date;
    public $member_id;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function setsalary_date($salary_date){
        $this->salary_date = $salary_date;
    }

     public function setmember_id($member_id) {
        $this->member_id = $member_id;
    }
    /**
     * calculation of salary and tax
     */
    public function indexAction() {
        $this->initialize();
        $salary_start_date = $this->salary_date;
        $SalaryDetail = new Models\SalaryDetail();
        $Salarymaster = new Models\SalaryMaster();
        $Attendance = new \salts\Salary\Models\Attendances();
        $countattday = $Attendance->getCountattday($salary_start_date);
                
        $getbasic_salary = $Salarymaster->getBasicsalary($countattday);
         var_dump($countattday);exit();
        //calculate overtime by attendances and salary master
        // $getcomp_startdate=$SalaryDetail->getCompStartdate();
        $creator_id = $this->member_id;
       
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
        return true;
    }

}


