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
require_once 'apps/notification/controllers/ControllerBase.php';
require_once 'apps/notification/controllers/NotiIndexControllerTest.php';

if (!isset($_SESSION))
    $_SESSION = array();

class NotificationCTTest extends PHPUnit_Framework_TestCase {

  

    public function testnotificationAction() {

        $noti = new NotiIndexControllerTest();
        $this->assertTrue($noti->notificationAction());
    }

    public function testdetailAction() {

        $noti = new NotiIndexControllerTest();
        $this->assertTrue($noti->detailAction());
    }

    public function testnotiattendancesAction() {

        $noti = new NotiIndexControllerTest();
        $this->assertTrue($noti->notiattendancesAction());
    }
    
    public function testviewallAction(){
         $noti = new NotiIndexControllerTest();
         $this->assertTrue($noti->viewallAction());
    }
    
     public function testupdateNotiAction(){
         $noti = new NotiIndexControllerTest();
         $this->assertTrue($noti->updateNotiAction());
}
}