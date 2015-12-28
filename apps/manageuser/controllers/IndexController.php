<?php

namespace salts\Manageuser\Controllers;
use salts\Manageuser\Models\User as User;
use salts\Core\Models\Db;
use salts\Dashboard\Models\CorePermissionGroupId;

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
        $this->module_name =  $this->router->getModuleName();
        $this->view->module_name = $this->module_name;
        //$this->act_name =  $this->router->getActionName();
        $this->permission = $this->setPermission($this->module_name);
        $this->view->t = $this->_getTranslation();
    }
        /**
        * @author David JP <david.gnext@gmail.com>
        * @desc   Array ,show all user data 
        * @since  18/7/15
        * @version 3/9/2015 @by David JP
        */
    public function IndexAction() {
        //for paging and edit user
        $User=new Db\CoreMember;
        $id=$this->session->user['member_id'];
        $noti=$User->GetAdminNoti($id);
        $this->view->setVar("noti",$noti);
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs("apps/manageuser/js/useredit.js");
        $this->assets->addJs('apps/manageuser/js/search.js'); 
        $getname = $User::getinstance()->getusername();
        $username = $this->request->get('username');
        $list = $this->user->userlist($username);
        
          $member_count = new Db\CoreMember();
       $member_count_number = $member_count->getNumberCount();
       $this->view->member_count_number = $member_count_number;
        if($member_count_number->deleted_flag == 200)
        {
            echo "200 Not Over";
        }
        else {
             echo "200 Not Over";
         }
        
        
        
        if($this->permission == 1){
        $this->view->modulename = $this->module_name;
        $this->view->setVar('username', $getname);
        $this->view->setVar('Result', $list);
        }
        else {
            $this->response->redirect('core/index');
        }
    } 
     //for monthly list autocomplete
    public function usernameautolistAction() {
        //echo json_encode($result);
         $UserList=new Db\CoreMember();
        $Username = $UserList->autousername(); 
        //print_r($UserList);exit;
        $this->view->disable();    
        echo json_encode($Username);
    } 
   
    /**
     * @get data for user id
     * @return type [new || edit]
     * @author David
     * @since 20/7/15
     */
    public function manageuserAction() {
        $type = $this->request->get('data');
        $t = $this->_getTranslation();
        $edit = array();
        if($type == 'new'){
            $edit[0] = $type;
            $edit[1]["add"] = $t->_("adduser");
            $edit[1]["name"] = $t->_("name");
            $edit[1]["username"] = $t->_("username");
            $edit[1]["pass"] = $t->_("password");
            $edit[1]["confirm"] = $t->_("confirm_pass");
            $edit[1]["dept"] = $t->_("dept");
            $edit[1]["pos"] = $t->_("position");
            $edit[1]["mail"] = $t->_("mail");
            $edit[1]["pno"] = $t->_("phone");
            $edit[1]["address"] = $t->_("address");
            $edit[1]["role"] = $t->_("user_role");
            $edit[1]["profile"] = $t->_("user_profile");
            $edit[1]["w_start_dt"] = $t->_("w_start_dt");
            $edit[1]["placeholder1"] = $t->_("placeholder1");
            $edit[1]["placeholder2"] = $t->_("placeholder2");
            $edit[1]["placeholder3"] = $t->_("placeholder3");
            $edit[1]["placeholder4"] = $t->_("placeholder4");
            $edit[1]["placeholder5"] = $t->_("placeholder5");
            $edit[1]["placeholder6"] = $t->_("placeholder6");
            $edit[1]["placeholder7"] = $t->_("placeholder7");
            $edit[1]["placeholder8"] = $t->_("placeholder8");
            $edit[1]["placeholder9"] = $t->_("placeholder9");
            $edit[1]["placeholder10"] = $t->_("placeholder10");
            echo json_encode($edit);
        }
        else{
        $res = $this->user->useredit($type);
            $edit[0] = $res[0];
            $edit[1]["edit"] = $t->_("edit_user");
            $edit[1]["id"] = $t->_("id");
            $edit[1]["name"] = $t->_("name");            
            $edit[1]["dept"] = $t->_("dept");
            $edit[1]["pos"] = $t->_("position");
            $edit[1]["mail"] = $t->_("mail");
            $edit[1]["pno"] = $t->_("phone");
            $edit[1]["address"] = $t->_("address");
            $edit[1]["w_start_dt"] = $t->_("w_start_dt");
            $edit[1]["btn_edit"] = $t->_("btn_edit");
            $edit[1]["btn_delete"] = $t->_("btn_delete");
            $edit[1]["btn_cancel"] = $t->_("btn_cancel");
        echo json_encode($edit);
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
        $cond['work_sdate']=$this->request->get('work_sdate');
        $result=$this->user->editbycond($cond);        
        echo json_encode($result);             // send validating data
        $this->view->disable();        
    }
         /*
     * @Count Member Limit
     * @Inset Buyer Code
     * @Yan Lin Pai <Yan Lin Pai>
     */
    public function adduserAction(){
     
//       $this->view->count = 
    }
        /**
        * ADD NEW USER 
        * @author Su Zin Kyaw
        */
       public function getpermitAction(){
     
        $permission=new CorePermissionGroupId();
        $result=$permission->getPermitName();
        echo json_encode($result);
        
        $this->view->disable();  
    }
}

