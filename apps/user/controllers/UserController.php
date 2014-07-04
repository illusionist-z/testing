<?php

namespace Crm\User\Controllers;

use Crm\User\Models\Db\Users;
use Crm\Core;

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

        $users = Users::getInstance()->get($condition);

        $json['status'] = 'OK';
        $json['users'] = $users;

        return $this->setJsonResponse($json);
        
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
    
    /**
     * Lorck user record by user id
     */
    public function lockAction($uuid){
        
        $lock = new Core\Models\Biz\LockRecord();
        $user = $lock->start($uuid);
        return $this->setJsonResponse(['uuid'=>$uuid,'user'=>$user]);
    }
    
    /**
     * 
     */
    public function updateAction(){
        $condition = $this->request->getPost();
        
        $update = new \Crm\User\Models\Biz\Users();
        $update->update($id, $parms);
    }
    
}

