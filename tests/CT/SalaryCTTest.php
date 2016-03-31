<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of IndexController
 *
 * @author Ei Thandar Aung <khinnyeinchanthu.gnext@gmail.com>
 */
require_once 'apps/salary/controllers/SalaryIndexController.php';
require_once 'apps/salary/controllers/SalarySearchController.php';
require_once 'apps/salary/controllers/MasterController.php';
require_once 'apps/salary/controllers/SalaryCalculateController.php';

if (!isset($_SESSION))
    $_SESSION = array();

class SalaryCTTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        
    }

    public function testsalarylistAction() {

        $salary = new SalaryIndexController();
        $this->assertTrue($salary->salarylistAction());
    }

//    public function testshowsalarylistAction() {
//        $month = "june";
//        $year = "2016";
//        $name = new SalaryIndexController();
//        $this->assertTrue($name->showsalarylistAction());
//    }

    public function testautolistAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->autolistAction());
    }

    public function testmonthlysalaryAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->monthlysalaryAction());
    }

//db
//    public function testpayslipAction() {
//        $salary = new SalaryIndexController();
//        $this->assertTrue($salary->payslipAction());
//    }

    public function testsalSettingAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->salSettingAction());
    }

//db
//    public function testgetmemberidAction() {
//        $uname = "admin";
//        $salary = new SalaryIndexController();
//        $salary->setuname($uname);
//        $this->assertTrue($salary->getmemberidAction());
//    }

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

//db
//    public function testeditallowanceAction() {
//        $name = new SalaryIndexController();
//        $this->assertTrue($name->editallowanceAction());
//    }


    public function testeditdataAction() {

        $allname = array("all_name" => "Bonus", "all_value" => "400000");
        $salary = new SalaryIndexController();
        $salary->setAllName($allname);
        $this->assertEquals("Bonus", $salary->editdataAction());
    }

//    db
//    public function testdeletedataAction() {        
//        $salary = new SalaryIndexController();
//        $this->assertTrue($salary->deletedataAction());
//    }

    public function testsalarysettingAction() {
        $salary = new SalaryIndexController();
        $this->assertTrue($salary->salarysettingAction());
    }

//db
//    public function testtaxdiaAction() {
//       
//        $name = new SalaryIndexController();
//        $this->assertTrue($name->taxdiaAction());
//    }
    //db
//    public function testedittaxAction() {
//
//
//        $tax = array("taxs_from" => '20000001', "taxs_to" => "30000000", "ssc_emp" => "20", "ssc_comp" => "2", "taxs_rate" => "3");
//        $salary = new SalaryIndexController();
//        $salary->setTax($tax);
//        $this->assertTrue($salary->edittaxAction());
//    }
//db
//    public function testdectdiaAction() {       
//        $name = new SalaryIndexController();
//        $this->assertTrue($name->dectdiaAction());
//    }

    public function testprintsalaryAction() {
        $salary = new SalaryIndexController();
        $member = array("month" => "2", "year" => "2016", "member_id" => "90e73464-c899-11e5-9e13-4c3488333b45");
        $salary->setMember($member);
        $this->assertTrue($salary->printsalaryAction());
    }

    public function testshow_add_dectAction() {
        $name = new SalaryIndexController();
        $this->assertTrue($name->show_add_dectAction());
    }

//db
//    public function testdeleteDeductAction() {
//
//        $name = new SalaryIndexController();
//        $this->assertTrue($name->deleteDeductAction());
//    }

    public function testsalarydetailAction() {
        $member = array("month" => "2", "year" => "2016", "member_id" => "90e73464-c899-11e5-9e13-4c3488333b45");
        $salary = new SalaryIndexController();
        $salary->setMember($member);
        $this->assertTrue($salary->salarydetailAction());
    }

//db
//    public function testaddresigndateAction() {
//        
//        $resignData = array("date" => "2016-07-31","member_id" => "90e73464-c899-11e5-9e13-4c3488333b45");
//        $salary = new SalaryIndexController();
//        $salary->setResignData($resignData);
//        $this->assertTrue($salary->addresigndateAction());
//    }


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

//    public function testaddsalaryAction(){
//        $salary = new SalaryIndexController();
//
//        $this->assertTrue($salary->addsalaryAction());
//    }
//    public function testMemberidforprintAction() {        
//        $salary = new SalaryIndexController();
//        $salary->setmember_id("4a83516d-c898-11e5-9e13-4c3488333b45");
//        $this->assertTrue($salary->memberidforprintAction());
//    }
//    // interupt
//
//    /*
//     * SearchController.php
//     */
//    /*
//     * indexAction to SalarySearchController
//     */
//     db
//    public function testindexAction() {
//        $search = new SalarySearchController();
//        $this->assertTrue($search->indexAction());
//    }

    public function testsearchTravelfeesAction() {
        $data = 1;
        $search_travel = new SalarySearchController();
        $search_travel->setparam($data);
        $this->assertTrue($search_travel->searchTravelfeesAction());
    }

//
//    /*
//     * SalaryMasterController.php
//     */
//   
//    
//    public function testsavesalaryAction() {
//        $permission = 1;
//        $uname = 'admin';
//        $bsalary = 300000;
//        $member_id = 'admin';
//        $add_salary = new MasterController();
// 
//        $add_salary->setuname($uname);
//        $add_salary->setbsalary($bsalary);
//        $add_salary->setpermission($permission);
//        $add_salary->setmember_id($member_id);
//        $this->assertEquals(array("result" => "Inserted"), $add_salary->savesalaryAction());
//    }
//    /*
//     * undefined cofig db:
//     */
////     public function testeditsalarydetailAction() {
////         $permission = 1;
////         
////         $bsalary = 300000;
////         $allowance = '';
////         $overtime = 10000;
////         $overtime_hr = 1;
////         $member_id = 'admin';
////         $year = '2015';
////         $month = '04';
////         $absent = 2;
////         $edit_salary = new MasterController();
////         $edit_salary->setpermission($permission);
////         $edit_salary->setbsalary($bsalary);
////         $edit_salary->setallowance($allowance);
////         $edit_salary->setovertime($overtime);
////         $edit_salary->setovertime_hr($overtime_hr);
////         $edit_salary->setmember_id($member_id);
////         $edit_salary->setyear($year);
////         $edit_salary->setmonth($month);
////         $edit_salary->setabsent($absent);
////         $this->assertTrue($edit_salary->editsalarydetailAction());
////     }
//    
//    /*
//     * CalculateController.php
//     */
//    /*
//     * undefined config db:
//     */
////     public function testindexAction() {
////         $salary_date = '2015-04-01';
////         $member_id = 'admin';
////         $cal = new SalaryCalculateController();
////         $cal->setsalary_date($salary_date);
////         $cal->setmember_id($member_id);
////         $this->assertTrue($cal->indexAction());
////     }
//    
}
