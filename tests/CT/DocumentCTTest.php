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
require_once 'apps/document/controller/DocumentInedxController.php';





if (!isset($_SESSION))
    $_SESSION = array();

class DocumentCTTest extends PHPUnit_Framework_TestCase {

    public static $_SESSION = array();

    public function setUp() {
        $_SESSION = DocumentCTTest::$_SESSION;
    }

     public function testinitialize() {
         $id = 'admin';
         $actname = 'letterhead';
         $module = 'document';
         $permission = 1;
         $key_name = 'show_admin_notification';
         $ini = new DocumentIndexController();
         $ini->setmember_id($id);
         $ini->setactname($actname);
         $ini->setmodule($module);
         $ini->setpermission($permission);
         $ini->setkey_name($key_name);
         $this->assertTrue($ini->initialize());
     }
      public function testssbdocumentAction() {
          $module = 1;
          $permit = 1;
          $ssb = new DocumentIndexController();
          $ssb->setmoduleIdCall($module);
          $ssb->setpermission($permit);
          $this->assertTrue($ssb->ssbdocumentAction());
      }
       public function testtaxdocumentAction() {
          $moduleIdCall = 1;
          $permission = 1;
          $module = 'document';
          $tax = new DocumentIndexController();
          $tax->setmoduleIdCall($moduleIdCall);
          $tax->setpermission($permission);
          $tax->setmodule($module);
          $this->assertTrue($tax->taxdocumentAction());
       }
//       public function testletterheadAction() {
//            $moduleIdCall = 1;
//          $permission = 1;
//          $module = 'document';
//          $module_id = 'dashboard';
//          $letter = new DocumentIndexController();
//          $letter->setmoduleIdCall($moduleIdCall);
//          $letter->setpermission($permission);
//          $letter->setmodule($module);
//          $letter->setmodule_id($module_id);
//          $this->assertTrue($letter->letterheadAction());  
//       }
//        public function testeditinfoAction() {
//            $edit = new DocumentIndexController();
//            $this->assertTrue($edit->editinfoAction());
//        }
        public function testsalaryreferAction() {
            $permission = 0;
            $data = '2016.02.29 00:00:00';
            $refer = new DocumentIndexController();
            $refer->setpermission($permission);
            $refer->setdata($data);
            $this->assertTrue($refer->salaryreferAction());
        }
        
}
