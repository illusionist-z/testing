<?php

namespace workManagiment\Manageuser\Controllers;
use workManagiment\Manageuser\Models\User as User;
use workManagiment\Core\Models\Db;

class IndexController extends ControllerBase
{
    public $user;
    public function initialize() {
        parent::initialize();    
        $this->user = new User();
        $this->setCommonJsAndCss();        
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/style.css');  
                          
        $this->assets->addJs('apps/manageuser/js/search.js'); 
        $this->assets->addJs("apps/manageuser/js/useredit.js");
    }
    /**
     * @author David
     * @desc   Array ,show all user data 
     * @since  18/7/15
     */
    public function userlistAction() {          
        $UserName = new Db\CoreMember();
        $getname = $UserName::getinstance()->getusername();
        $username = $this->request->get('username');
        $list = $this->user->userlist($username);
        $this->view->setVar('username', $getname);
        $this->view->setVar('Result', $list); 
        $this->assets->addJs('common/js/paging.js');     
    }    
   
    /**
     * @get data for user id
     * @return user data to dialog box
     * @author David
     * @since 20/7/15
     */
    public function usereditAction() {                       
        $name = $this->request->get('data');        
        $edit = $this->user->useredit($name);                
        echo json_encode($edit[0]);
        $this->view->disable();        
    }  
    /**
     * @author David
     * @type   data id
     * @desc   Delete user by id
     * @since  20/7/15
     */
    public function deleteuserAction(){
        $id = $this->request->get('data');                
        $this->user->userdelete($id);
        $this->view->disable();
    }
    /**     
     * @type   form data
     * @desc   update user
     * @since  20/7/15
     */
    public function userdata_editAction() {        
        $cond = array();
        $cond['id']  =  $this->request->get('data');
        $cond['name']=$this->request->get('name');
        $cond['dept']=$this->request->get('dept');
        $cond['position']=$this->request->get('position');
        $cond['email']=$this->request->get('email');
        $cond['pno']=$this->request->get('pno');
        $cond['address']=$this->request->get('address');
        $result=$this->user->editbycond($cond);        
        echo json_encode($result);             // send validating data
        $this->view->disable();        
    }
    /**
     * ADD NEW USER 
     * @author Su Zin Kyaw
     */
    public function adduserAction(){
        
        $this->view->setVar('type','userlist');
        
    }
}

