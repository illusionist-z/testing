<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Core\Models\Db;
use salts\Salary\Controllers;
use salts\Salary\Models;
use salts\Salary\Models\SalaryDetail;
use salts\Salary\Models\SalaryMaster;

include_once 'tests\CT\apps\LoginForAll.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class SalarySearchController extends Controllers\SearchController {

    public $param;

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
        $SalaryDetail = new SalaryDetailTest();
        $cond = $this->request->get('cond', array());
        $search_result = $SalaryDetail->searchSalary($cond);
        $this->view->disable();
        echo json_encode($search_result);
        return true;
    }

    /*
     * undefined $field
     */

    public function searchTravelfeesAction($exportMode = null) {
        $this->initialize();
        $data = $this->param;
        $SalaryDetail = new SalaryDetailTest();
        $search_result = $SalaryDetail->searchSList($data,0);       
        return true;
    }

}
