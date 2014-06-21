<?php

namespace Crm\Auth\Controllers;

use Crm\Auth\Models;

class LoginController extends ControllerBase
{

    public function indexAction()
    {
        $loginParams = $this->request->get();
        $this->view->test = $loginParams;
        $modelAuth = new Models\Auth();
        
        $user = array();
        if($modelAuth->check($loginParams,$user)){
            $modelPermission = new Models\Permission();
            $permissions = [];
            
            //Set user's permission to session 
            $modelPermission->get($user,$permissions);
            $this->session->set('auth',$permissions);
        }else{
            $this->response->redirect('auth/index/failer');
        }
        
        // When user's login succeed , move to dashboad
        
        
            
    }
    
    

}

