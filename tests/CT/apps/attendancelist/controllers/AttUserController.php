<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use salts\Manageuser\Models\User as User;
use salts\Core\Models\Db;
use salts\Attendancelist\Controllers;
use salts\Attendancelist\Models;

include_once 'tests\CT\apps\LoginForAll.php';

require_once 'apps/attendancelist/controllers/UserController.php';

/**
 * Description of IndexController
 *
 * @author Khin Nyein Chan Thu <khinnyeinchanthu.gnext@gmail.com>
 */
class AttUserController extends Controllers\UserController {

   

    public function initialize() {
        $login = new LoginForAll();
        $login->loginFirst();
    }


    public function attendancelistAction() {
        $this->initialize();
       
        if (isset($this->session->tzoffset)) {
            $offset = $this->session->tzoffset['offset'];
            $timezone = $this->session->tzoffset['timezone'];
            $this->view->timezone = $timezone;
        } else {
            $offset = $this->session->location['offset'];
             
        }
        $startdate = $this->request->get('startdate');
        $enddate = $this->request->get('enddate');
        $currentPage = $this->request->get('page');
        $id = $this->session->user['member_id'];
        $AttList = new \salts\Attendancelist\Models\Attendances();
        $Result_Attlist = $AttList->getAttList($id, $startdate, $enddate, $currentPage);
        return true;
    }

}
