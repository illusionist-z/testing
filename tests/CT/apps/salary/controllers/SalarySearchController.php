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

require_once 'apps/salary/controllers/SearchController.php';
require_once 'apps/core/models/db/CoreMember.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class SalarySearchController extends Controllers\SearchController {
  
    public $param;
    public $login_params = array('company_id' => 'cop1', "member_login_name" => "admin", "password" => "admin");

    public function setparam($param) {
        $this->param = $param;
    }

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }
/*
 * $cond fill value
 */
    public function indexAction() {
        $this->initialize();
    //    if ($this->request->isAjax() == true) {
            $SalaryDetail = new SalaryDetail();
            $cond = $this->request->get('cond', array());
            $search_result = $SalaryDetail->searchSalary($cond);
//            $this->view->disable();
//            echo json_encode($search_result);
    //    }
        return true;
    }

    /*
     * undefined $field
     */
    public function searchTravelfeesAction() {
        $this->initialize();
        $param = $this->param;
        $SalaryDetail = new Models\SalaryDetail();
        $search_result = $SalaryDetail->searchSList($param);
//        $this->view->disable();
//        echo json_encode($search_result);
        return true;
    }
}