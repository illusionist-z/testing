<?php

namespace workManagiment\Manageuser\Controllers;
use workManagiment\Manageuser\Models\User as User;
/**
 * @author David
 * @type   User Editing
 * @data   Abstract User Model as $user
 */
class UserController extends ControllerBase {
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
     * @author David
     * @desc   Array ,show all user data 
     * @since  18/7/15
     */
    public function userlistAction() {               
        $list = $this->user->userlist();
        $username = $this->request->get('username');
        if(NULL != $username){
            $search=$this->user->searchresult($username);
        }
        else{
            $search=$list = $this->user->userlist();

        }
        $this->view->setVar('username', $list);
        $this->view->setVar('Result', $search);
        $this->view->setVar('type', 'userlist');
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
        $this->view->setVar('edituser', $edit);
        $this->view->setVar('type', 'useredit');
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
        $this->user->editbycond($cond);        
        $this->view->disable();        
    }
    public function adduserAction(){
        
        $this->view->setVar('type','userlist');
        if ($this->request->isPost()) {
            $username= $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $dept = $this->request->getPost('dept');
            $position = $this->request->getPost('position');
            $email=$this->request->getPost('email');
            $phno= $this->request->getPost('phno');
            $address= $this->request->getPost('address');
            $filename=$_FILES["fileToUpload"]["name"];
            $newuser=new \workManagiment\Core\Models\Db\CoreMember;
            $newuser->addnewuser($username,$password, $dept, $position, $email,$phno,$address,$filename );            
           
            $this->view->disable();
        } 
    }
}
