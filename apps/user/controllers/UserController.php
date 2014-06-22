<?php

namespace Crm\User\Controllers;

use Crm\User\Models\Db\Users;

class userController extends ControllerBase
{
    
    public $users = array();
    
    public function initialize() {
        parent::initialize();
    }
    
    public function indexAction(){
        
    }
    
    public function getAction(){
        
        $condition = $this->request->getPost();

        if(Users::getInstance()->get($condition,$this->users)){
            
        }

        $this->view->disable();
        $json['status'] = 'OK';
        $json['users'] = $this->users;
        $this->response->setContentType('application/json', 'UTF-8');
        echo json_encode($json);
        
    }
    
}

