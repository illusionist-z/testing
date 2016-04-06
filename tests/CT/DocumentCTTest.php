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
require_once 'apps/document/controller/DocumentIndexController.php';

if (!isset($_SESSION))
    $_SESSION = array();

class DocumentCTTest extends PHPUnit_Framework_TestCase {

    public function testssbdocumentAction() {

        $ssb = new DocumentIndexController();

        $this->assertTrue($ssb->ssbdocumentAction());
    }

    public function testtaxdocumentAction() {

        $tax = new DocumentIndexController();
        $this->assertTrue($tax->taxdocumentAction());
    }

    public function testletterheadAction() {

        $letter = new DocumentIndexController();
        $this->assertTrue($letter->letterheadAction());
    }

// error
//    public function testeditinfoAction() {
//        $document = new DocumentIndexController();
//       $file = array("name" => "myfile.png" ,"type" => "image/png" ,"tmp_name" => "myfile.tmp", "size" => 500);
//        $document->setFile($file);
//        $this->assertTrue($document->editinfoAction());
//    }

    public function testcheckimgsize() {
        $mesg = 'File too large. File must be less than 10 megabytes.';
        $document = new DocumentIndexController();
        $file = array("name" => "myfile.png", "type" => "image/png", "tmp_name" => "myfile.tmp", "size" => 12220);
        $document->setFile($file);
        $this->assertEquals($mesg, $document->editinfoAction());
    }

    public function testcheckimgtype() {
        $msg = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
        $document = new DocumentIndexController();
        $file = array("name" => "myfile.png", "type" => "text/plain", "tmp_name" => "myfile.tmp", "size" => 5);
        $document->setFile($file);
        $this->assertEquals($msg, $document->editinfoAction());
    }

    public function testsalaryreferAction() {

        $refer = new DocumentIndexController();
        $name = "G - NEXT Co.,Ltd";
        $this->assertEquals($name, $refer->salaryreferAction());
    }

}
