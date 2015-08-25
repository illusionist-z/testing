<?php

namespace workManagiment\Manageuser\Controllers;

use workManagiment\Manageuser\Models\User as User;
use workManagiment\Manageuser\Models\AddUser;
use workManagiment\Core\Models\Db;
use workManagiment\Core\Models\Db\CoreMember;

/**
 * @author David
 * @type   User Editing
 * @data   Abstract User Model as $user
 */
class CorememberController extends ControllerBase {    

    public $user;

    public function initialize() {
        parent::initialize();
        $this->user = new User();
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/style.css');
        $this->assets->addJs('apps/manageuser/js/search.js');
    }

    /**
     * ADD NEW USER 
     * @author Su Zin Kyaw
     */
    public function saveuserAction() {
       if($this->request->isPost()){
           $user = new AddUser();
           $validate = $user->validate($this->request->getPost());
           if(count($validate)){
               foreach ($validate as $message){
                   $json = $message->getMessage();
               }               
               }
           
           echo json_encode($json);
           $this->view->disable();
       }
        }
                  

}
