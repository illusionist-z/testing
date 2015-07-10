<?php

namespace workManagiment\Auth\Controllers;

use workManagiment\Auth\Models;

class LoginController extends ControllerBase {

    public function indexAction() {
        
        $loginParams = $this->request->get();
       
        $this->view->test = $loginParams;
//        print_r($loginParams);exit;
        $modelAuth = new Models\Auth();
        $result = $modelAuth->check($loginParams, $user);
        //print_r($result);exit;
        $user = array();
        if ($result) {

            $modelPermission = new Models\Permission();
            $permissions = [];
//            print_r($user);exit;
            //Set user's permission to session 
            $Permission = $modelPermission->get($result, $permissions);
            
            $this->session->set('auth', $Permission);
            
        } else {
            $this->response->redirect('auth/index/failer');
        }

        // When user's login succeed , move to dashboad
        $this->response->redirect('home');
    }

}
