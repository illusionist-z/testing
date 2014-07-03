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

        $users = Users::getInstance()->get($condition,$this->users);

        $this->view->disable();
        $json['status'] = 'OK';
        $json['users'] = $users;
        $this->response->setContentType('application/json', 'UTF-8');
        echo json_encode($json);
        
    }
    
    /**
     * get one user data by id
     * @param type $id
     * @return json Description
     */
    public function getOneAction($id = NULL){
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        
        $json['status'] = 'NG';
        $json['msg'] = 'bad request';
        // error not id
        if($id === NULL){
            echo json_encode($json);
            return;
        }
        //find user
        $json['user'] = Users::findFirstById($id);
        if(NULL !== $json['user']){
            $json['status'] = 'OK';
        }
        
        echo json_encode($json);
    }
    
}

