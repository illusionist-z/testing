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

include_once 'tests\CT\apps\LoginForAll.php';
require_once 'apps/auth/lang/jp.php';

//namespace Test;

if (!isset($_SESSION))
    $_SESSION = array();

class LogoutControllerTest extends Controllers\LogoutController {

    //put your code here

    public function initialize() {

        $login = new LoginForAll();
        $login->loginFirst();
    }

    public function indexAction() {
        
        $this->initialize();
        $this->session->remove('location');
        $this->session->remove('permission_code');

        $this->cookies->get('cookies')->delete();

        $this->session->destroy();
        $this->response->redirect('index/index');
    }

    public function gettranslateAction() {
         
        $this->initialize();
        $t = $this->_getTranslation();
        $data['logout'] = $t->_("logout");
        $this->view->disable();
        echo json_encode($data);
    }

}
