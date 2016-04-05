<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of IndexController
 *
 * @author Ei Thandar Aung 
 */
include_once 'apps/salary/controllers/SalaryCalculateController.php';

if (!isset($_SESSION))
    $_SESSION = array();

class SalaryCTTest extends PHPUnit_Framework_TestCase {

    public function testsalarylistAction() {

        $salary = new SalaryIndexController();
        $this->assertTrue($salary->salarylistAction());
    }

    public function testshowsalarylistAction() {
        $salary = new SalaryIndexController();
        $salary->setmonth("2");
        $salary->setyear("2016");
        $this->assertTrue($salary->showsalarylistAction());
    }

    public function testautolistAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->autolistAction());
    }

    public function testmonthlysalaryAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->monthlysalaryAction());
    }

//error
//    public function testpayslipAction() {
//        $salary = new SalaryIndexController();
//        $this->assertTrue($salary->payslipAction());
//    }

    public function testsalSettingAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->salSettingAction());
    }

    public function testgetmemberidAction() {
        $uname = "admin";
        $salary = new SalaryIndexController();
        $salary->setname($uname);
        $result = $salary->getmemberidAction();
        $this->assertEquals("admin", $result[0]["member_login_name"]);
    }

    public function testallowanceAction() {

        $salary = new SalaryIndexController();
        $this->assertTrue($salary->allowanceAction());
    }

    public function testsaveallowanceAction() {
        $salary = new SalaryIndexController();
        $allname = array("all_name" => "Bonus", "all_value" => "400000");
        $salary->setAllName($allname);
        $salary->setState(1);
        $result = $salary->saveallowanceAction();
        $this->assertEquals("Allowances are added successfully!", $result);
    }

    public function testNotsaveallowanceAction() {
        $salary = new SalaryIndexController();
        $result = $salary->saveallowanceAction();
        $this->assertEquals("No data!Insert Data First", $result);
    }

    public function testeditallowanceAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->editallowanceAction());
    }

    public function testeditdataAction() {

        $allname = array("all_name" => "Transpotation", "all_value" => "400000");
        $salary = new SalaryIndexController();
        $salary->setAllName($allname);
        $this->assertEquals("Transpotation", $salary->editdataAction());
    }

    public function testdeletedataAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->deletedataAction());
    }

    public function testsalarysettingAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->salarysettingAction());
    }

    public function testtaxdiaAction() {
        $name = new SalaryIndexController();
        $this->assertTrue($name->taxdiaAction());
    }

    public function testedittaxAction() {
        $tax = array("taxs_from" => '20000001', "taxs_to" => "30000000", "ssc_emp" => "20", "ssc_comp" => "2", "taxs_rate" => "3");
        $salary = new SalaryIndexController();
        $salary->setTax($tax);
        $this->assertTrue($salary->edittaxAction());
    }

    public function testdectdiaAction() {
        $name = new SalaryIndexController();
        $this->assertTrue($name->dectdiaAction());
    }

    public function testprintsalaryAction() {
        $salary = new SalaryIndexController();
        $member = array("month" => "2", "year" => "2016", "member_id" => "90e73464-c899-11e5-9e13-4c3488333b45");
        $salary->setMember($member);
        $this->assertTrue($salary->printsalaryAction());
    }

    public function testAddDectAction() {
        $salary = new SalaryIndexController();
        $deduce = array("deduce_name" => "spouse", "amount" => "40000");
        $salary->setDeduce($deduce);
        $this->assertTrue($salary->addDectAction());
    }

    public function testshow_add_dectAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->show_add_dectAction());
    }

    public function testdeleteDeductAction() {

        $salary = new SalaryIndexController();
        $this->assertTrue($salary->deleteDeductAction());
    }

    public function testsalarydetailAction() {
        $member = array("month" => "2", "year" => "2016", "member_id" => "90e73464-c899-11e5-9e13-4c3488333b45");
        $salary = new SalaryIndexController();
        $salary->setMember($member);
        $this->assertTrue($salary->salarydetailAction());
    }

    public function testaddresigndateAction() {

        $resignData = array("date" => "2016-07-31", "member_id" => "1b7ddc0a-c897-11e5-9e13-4c3488333b45");
        $salary = new SalaryIndexController();
        $salary->setResignData($resignData);
        $this->assertTrue($salary->addresigndateAction());
    }

    public function testcheckmonthyearAction() {
        $monthyear = '2016-02-29';
        $salary = new SalaryIndexController();
        $salary->setmonthyear($monthyear);
        $this->assertEquals("found", $salary->checkmonthyearAction());
    }

    public function testInvalidcsvimportAction() {
        $id = 2;
        $salary = new SalaryIndexController();
        $result = $salary->csvimportAction($id);
        $this->assertEquals("Invalid file format . (CSV only allowed)", $result[1]);
    }

    public function testExcelcsvimportAction() {
        $id = 2;
        $salary = new SalaryIndexController();
        $salary->setname("myfile.xlsx");
        $result = $salary->csvimportAction($id);
        $this->assertEquals("Covert excel file to csv !!", $result[0]);
    }

    public function testCsvValidationAction() {
        $id = 2;
        $salary = new SalaryIndexController();
        $salary->setname("test.csv");
        $salary->settmp('\test.tmp');
        $result = $salary->csvimportAction($id);
        $this->assertEquals("basic_salary_annual is required ,total_annual_income is required ,basic_examption is required ,print_id is required ", $result[2]);
    }

    public function testDownloadcsvAction() {
        $id = 1;
        $salary = new SalaryIndexController();

        $this->assertTrue($salary->downloadcsvAction($id));
    }

    public function testaddsalaryAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->addsalaryAction());
    }

    public function testMemberidforprintAction() {
        $salary = new SalaryIndexController();
        $mem = array("mem1" => "4a83516d-c898-11e5-9e13-4c3488333b45");
        $salary->setmember_id($mem);
        $result = $salary->memberidforprintAction();
        $this->assertEquals("success", $result);
    }

//note
//    public function testsearchTravelfeesAction() {
//        $data = 1;
//        $search_travel = new SalarySearchController();
//        $search_travel->setparam($data);
//        $this->assertTrue($search_travel->searchTravelfeesAction());
//    }
//
    /*
     * SalaryMasterController.php
     */
   
    
    public function testsavesalaryAction() {


        $salary = array("radTravel" => "2", "no_of_children" => "2",
            "checkall" => "spouse",
            "check_allow" => "4a53fcdc-3d17-11e5-b0fa-00ff56603869",
            "member_id" => "90e73464-c899-11e5-9e13-4c3488333b45", "bsalary" => "300", "sdate" => "03/01/2016");

        $master = new MasterController();
        $master->setSalary($salary);

        $this->assertTrue($master->savesalaryAction());
    }

    public function testEditSalaryDetailAction() {
        $master = new MasterController();
        $editsalary = array("bsalary" => "900000", "overtime" => "3000", "member_id" => "90e73464-c899-11e5-9e13-4c3488333b45",
            "overtime_hr" => "2", "specific_dedce" => "3000", "specific_dedce" => "2000", "year" => "2016", "month" => "2", "absent" => "2");
        $master->setEditSalary($editsalary);
        $this->assertTrue($master->editsalarydetailAction());
    }

    /*
     * CalculateController.php
     */

    public function testindexAction() {
        $salary_date = '2015-04-01';

        $cal = new SalaryCalculateController();
        $cal->setsalary_date($salary_date);

        $this->assertTrue($cal->indexAction());
    }

}
