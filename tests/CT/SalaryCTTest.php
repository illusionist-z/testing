<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttendanceCITest
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
require_once 'apps/salary/controllers/SalaryIndexController.php';
require_once 'apps/salary/controllers/SalarySearchController.php';
require_once 'apps/salary/controllers/MasterController.php';
require_once 'apps/salary/controllers/SalaryCalculateController.php';


if (!isset($_SESSION))
    $_SESSION = array();

class SalaryCTTest extends PHPUnit_Framework_TestCase {

    public static $_SESSION = array();

    public function setUp() {
        $_SESSION = SalaryCTTest::$_SESSION;
    }

    public function testsalarylistAction() {
        $moduleIdCall = 1;
        $page = 1;
        $permission = 1;
        $salary_list = new SalaryIndexController();
        $salary_list->setmoduleIdCall($moduleIdCall);
        $salary_list->setpage($page);
        $salary_list->setpermission($permission);
        $this->assertTrue($salary_list->salarylistAction());
    }

    /*
     * undefined property db
     */

//     public function testshowsalarylistAction() {
//        $moduleIdCall = 1;
//        $month = 'February';
//        $year= 2016;
//        $salary_show = new SalaryIndexController();
//        $salary_show->setmoduleIdCall($moduleIdCall);
//        $salary_show->setmonth($month);
//        $salary_show->setyear($year);
//        $this->assertTrue($salary_show->showsalarylistAction());
//     }



    /*
     * SearchController.php
     */
    /*
     * indexAction to SalarySearchController
     */
//     public function testindexAction() {
//         $search = new SalarySearchController();
//         $this->assertTrue($search->indexAction());
//     }
//     public function testsearchTravelfeesAction() {
//        
//         $data = 1;
//         $search_travel = new SalarySearchController();
//         $search_travel->setparam($data);
//         $this->assertTrue($search_travel->searchTravelfeesAction());
//     }

    /*
     * SalaryMasterController.php
     */
   
      public function testsalaryinitialize() {
          $salary_ini = new MasterController();
          $this->assertTrue($salary_ini->salaryinitialize());
      }
    public function testsavesalaryAction() {
        $permission = 1;
        $uname = 'admin';
        $bsalary = 300000;
        $member_id = 'admin';
        $add_salary = new MasterController();
 
        $add_salary->setuname($uname);
        $add_salary->setbsalary($bsalary);
        $add_salary->setpermission($permission);
        $add_salary->setmember_id($member_id);
        $this->assertEquals(array("result" => "Inserted"), $add_salary->savesalaryAction());
    }
    /*
     * undefined cofig db:
     */
//     public function testeditsalarydetailAction() {
//         $permission = 1;
//         
//         $bsalary = 300000;
//         $allowance = '';
//         $overtime = 10000;
//         $overtime_hr = 1;
//         $member_id = 'admin';
//         $year = '2015';
//         $month = '04';
//         $absent = 2;
//         $edit_salary = new MasterController();
//         $edit_salary->setpermission($permission);
//         $edit_salary->setbsalary($bsalary);
//         $edit_salary->setallowance($allowance);
//         $edit_salary->setovertime($overtime);
//         $edit_salary->setovertime_hr($overtime_hr);
//         $edit_salary->setmember_id($member_id);
//         $edit_salary->setyear($year);
//         $edit_salary->setmonth($month);
//         $edit_salary->setabsent($absent);
//         $this->assertTrue($edit_salary->editsalarydetailAction());
//     }
    
    /*
     * CalculateController.php
     */
    /*
     * undefined config db:
     */
//     public function testindexAction() {
//         $salary_date = '2015-04-01';
//         $member_id = 'admin';
//         $cal = new SalaryCalculateController();
//         $cal->setsalary_date($salary_date);
//         $cal->setmember_id($member_id);
//         $this->assertTrue($cal->indexAction());
//     }
}
