<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutControllerTest
 *
 * @author Khine Thazin Phyo <ktzp27@gmail.com>
 */
use salts\Auth\Controllers;
use salts\Auth\Models;
use salts\Core\Models\Db\CoreMember;
use Phalcon\Filter;




//namespace Test;

class LogoutControllerTest extends Controllers\LogoutController {

    //put your code here


    public function indexAction() {
        $this->session->remove('location');
        $this->session->remove('permission_code');
        $this->response->redirect('index/index');
        return true;
    }
   

}
