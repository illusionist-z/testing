<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
use salts\Salary\Controllers;
use salts\Salary\Models;

/**
 * Description of SalaryMasterController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class MasterController extends Controllers\SalaryMasterController {

    public $salary;
    public $editsalary;

    public function setEditSalary($editsalary) {
        $this->editsalary = $editsalary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();

        $this->setCommonJsAndCss();
        $this->act_name = "salary";
        $this->permission = "1";
    }

    public function savesalaryAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $chkTravelfees = $this->salary["radTravel"];
            $data['no_of_children'] = $this->salary["no_of_children"];
            $dedution = $this->salary["checkall"];
            $allowance = $this->salary["check_allow"];
            $data['id'] = uniqid();
            $data['member_id'] = $this->salary['member_id'];
            $data['basic_salary'] = $this->salary['bsalary'];
            $setdata = $this->setSalaryData($chkTravelfees, "20000", "30000");

            $sdate = $this->salary['sdate'];
            $data['salary_start_date'] = date("Y-m-d", strtotime($sdate));
            $byear = date("Y", strtotime($sdate)) + 1;
            $data['salary_end_date'] = $byear . "-03-31";

            $data['creator_id'] = $this->session->user['member_id'];

            $data = array_merge($data, $setdata);



            return true;
        }
    }

    public function editsalarydetailAction() {
        $this->initialize();
        if ($this->permission == 1) {
            $bsalary = $this->editsalary['bsalary'];
            $overtimerate = $this->editsalary['overtime'];
            $member_id = $this->editsalary['member_id'];
            $overtime_hr = $this->editsalary['overtime_hr'];
            $allowance = $this->editsalary['specific_dedce'];
            $workingstartdt = $this->editsalary['workingstartdt'];
            $year = $this->editsalary['year'];
            $month = $this->editsalary['month'];
            $absent = $this->editsalary['absent'];
            $SalaryMaster = new Master();

            $SalaryMaster->updateSalarydetail($bsalary, $overtimerate, $member_id, $overtime_hr,$year,$month);
            $Salarydetail = new SalaryDetailTest();
            $resultsalary = $Salarydetail->updateSalarydetail($bsalary, $allowance, $member_id, $year, 
                $month, $absent, $overtime_hr, $overtimerate,$workingstartdt);
            //$this->view->disable();
//            echo json_encode($resultsalary);
            return true;
        }
    }

}
