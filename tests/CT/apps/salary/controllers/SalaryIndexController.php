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

require_once 'apps/salary/controllers/IndexController.php';
require_once 'apps/core/models/db/CoreMember.php';
require_once 'apps/salary/models/SalaryDetail.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class SalaryIndexController extends Controllers\IndexController {

    public $moduleIdCall;
    public $page;
    public $month;
    public $year;
    
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");

    public function setmoduleIdCall($moduleIdCall) {
        $this->moduleIdCall = $moduleIdCall;
    }

    public function setpage($page) {
        $this->page = $page;
    }

    public function setpermission($permission) {
        $this->permission = $permission;
    }

    public function setmonth($month) {
        $this->month = $month;
    }

    public function setyear($year) {
        $this->year = $year;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function salarylistAction() {
        $this->initialize();
       
        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $SalaryDetail = new models\SalaryDetail();
            $curretPage = $this->page;
            $get_salary_detail = $SalaryDetail->getSalaryDetail($curretPage);
            if ($this->permission == 1) {
//                $this->view->module_name = $this->router->getModuleName();
//                $this->view->salarydetail = $get_salary_detail;
            } else {

                $this->response->redirect('core/index');
            }
        } else {
            $this->response->redirect('core/index');
        }
        return true;
    }

    /**
     * Show salary list for monthly detail
     * @author zinmon
     */
    public function showsalarylistAction() {
        $this->initialize();
        if ($this->moduleIdCall == 1) {
            $this->assets->addJs('apps/salary/js/base.js');
            $this->assets->addJs('apps/salary/js/index-show-salarylist.js');

            $month = $this->month;
            $year = $this->year;
            $SalaryDetail = new Models\SalaryDetail();
            $get_salary_list = $SalaryDetail->salarylist($month, $year);
            $UserList = new Db\CoreMember();
            $user_name = $UserList->find();
//            $this->view->setVar("month", $month);
//            $this->view->setVar("year", $year);
//            $this->view->setVar("usernames", $user_name);
//            $this->view->setVar("getsalarylists", $get_salary_list);
//            $this->view->setVar("allowancenames", $allowancename);
//            $this->view->module_name = $this->router->getModuleName();
        } else {
            $this->response->redirect('core/index');
        }
    }

}
