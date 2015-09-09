<?php

namespace workManagiment\Manageuser\Controllers;
use workManagiment\Manageuser\Models\User as User;
use workManagiment\Core\Models\Db;

class IndexController extends ControllerBase
{
    public $user;
    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->user = new User();
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addJs('apps/manageuser/js/adduser.js');
        $this->assets->addCss('apps/manageuser/css/manageuser.css');
    }
    /**
     * @author David JP <david.gnext@gmail.com>
     * @desc   Array ,show all user data 
     * @since  18/7/15
     * @version 3/9/2015 @by David JP
     */
    public function userlistAction() {
        //for paging and edit user
        $User=new Db\CoreMember;
        $noti=$User->GetAdminNoti();
        $this->view->setVar("noti",$noti);
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs("apps/manageuser/js/useredit.js");
        $this->assets->addJs('apps/manageuser/js/search.js'); 
        $getname = $User::getinstance()->getusername();
        $username = $this->request->get('username');
        $list = $this->user->userlist($username);
       
        $this->view->setVar('username', $getname);
        $this->view->setVar('Result', $list);         
    }    
   
    /**
     * @get data for user id
     * @return type [new || edit]
     * @author David
     * @since 20/7/15
     */
    public function manageuserAction() {
        $type = $this->request->get('data');
        if($type == 'new'){
            echo json_encode($type);
        }
        else{
        $edit = $this->user->useredit($type);
        echo json_encode($edit[0]);
        }
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
       
    }
}

