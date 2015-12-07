<?php

use Phalcon\Config;
use Phalcon\Mvc\Url as UrlProvider;
namespace workManagiment\Setting\Controllers;
use workManagiment\Setting\Models\CorePermissionGroup; 
use workManagiment\Setting\Models\CorePermissionGroupId; 
use workManagiment\Setting\Models\CorePermissionRelMember; 
use workManagiment\Core\Models\Db\CoreMember;
use workManagiment\Core\Models\Db;
use Phalcon\Http\Response;
 


/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */

class IndexController extends ControllerBase {

   public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');  
        $this->assets->addJs('common/js/paging.js'); 
        $this->assets->addJs('apps/setting/js/index.js'); 
        $this->assets->addJs('apps/setting/js/setting.js');  
        $this->config = \Module_Config::getModuleConfig('leavedays');
  
        $this->module_name =  $this->router->getModuleName();        
        $this->permission = $this->setPermission();             
        $this->view->module_name=$this->module_name;
        $this->view->permission = $this->permission;
        
        }
    
    
        /**
        * @author David JP <david.gnext@gmail.com>
        * @desc    $core_group = {}
        * @Cover  Yan Lin Pai <wizardrider@gmail.com>
        * @desc    $core_groupid = {}
        * @desc    $core_user = {}
        */
        public function indexAction() { 
           if($this->permission==1){
                $coreid = new CorePermissionGroupId(); 
                $corememberid = new CorePermissionRelMember(); 
                $coreuser = new CoreMember(); 
                $coreuser2 = new CorePermissionGroup(); 
                $core_groupid=$coreid::find();
                $coremember= $corememberid::find();
                $core_groupuser2=$coreuser2::find();
                $core_groupuser=$coreuser->getgroupid();
                $this->view->coreid = $core_groupid;
                $this->view->coremember = $coremember; 
                $this->view->coreuser = $core_groupuser; 
                $this->view->coreuser2 = $core_groupuser2; 
                $id=$this->session->user['member_id'];
                $noti=$coreuser->GetAdminNoti($id);
                $this->view->setVar("noti", $noti);
           }
           else {
               
                 $this->response->redirect('setting/user/usersetting');
           }
        }     
        /**
        * @author Yan Lin Pai <wizardrider@gmail.com>
        * @desc    $core = {}
        * @public function 4 set
        */
        public function AddGroupRuleAction()
        {
        $core = new CorePermissionGroupId();
        $core->save($this->request->getPost());
        $this->view->disable();
        $this->response->redirect('setting/index');
        }
        /**
         * @author David JP <david.gnext@gmail.com>
         * @option[] - return array
         */
         public function AddPageRuleAction()
        {
        $creator_id = $this->session->user['member_id'];
        $created_dt = date("Y-m-d H:i:s");
        $core = new CorePermissionGroup();
        $option = explode("_",  $this->request->getPost('page_rule_group'));
        $core->page_rule_group = $option[0];
        $core->permission_group_code = $option[1];
        $core->permission_group_name = strtolower($option[1]);
        $core->creator_id = $creator_id;
        $core->created_dt = $created_dt;
        $core->permission_code = $this->request->getPost('permission_code');
        $core->save();
        $this->view->disable();
        $this->response->redirect('setting/index');
        }
        
        public function DelGroupRuleAction()
        {
        $core = new CorePermissionGroupId();
        $core = CorePermissionGroupId::Find($this->request->getPost('group_id'));
        $core->delete();
        $this->view->disable();        
        }
          /**
         * @author YanLin Pai <wizardrider@gmail.com>
         * @DelPageRuleAction
         */
         public function DelPageRuleAction()
        {
        $core = new CorePermissionGroup();
        $core = CorePermissionGroup::Find($this->request->getPost('idpage'));
        $core->delete();
        $this->view->disable();        
        }
        public function GroupRuleSettingAction()
        {
        $group_name = $this->request->getPost('name_of_group');
        $core = new CorePermissionGroupId();
        $core =CorePermissionGroupId::FindFirst('group_id ='.$this->request->getPost('group_id'));
        $core->name_of_group = strtoupper($group_name);
        $core->update();        
        $this->view->disable();
        $this->response->redirect('setting/index');
        }
         /**
        * @author Yan Lin Pai <wizardrider@gmail.com>
        * @desc    $core = {}
        * @public function 4 set
        */     
        public function User2RuleSettingAction()
        {     
                $idpage = $this->request->getPost("idpage");
                $page_rule_group = $this->request->getPost("page_rule_group");
                $permission_code = $this->request->getPost("permission_code");var_dump($permission_code);
                $core = new CorePermissionGroup();
                $success = $core->corepermissionUpdate($idpage,$page_rule_group,$permission_code);  //updating field permission
                if($success)
                {
                $this->view->disable();
                $this->response->redirect('setting/index');
                }
                else  { echo "Failed!!"; }
        }
        
          public function UserRuleSettingAction()
        {                                 
        $core = new CorePermissionRelMember();
        $id = $this->request->getPost('rel_member_id');
        $group_id =  $this->request->getPost('group_id');
        $group_name = $this->request->getPost('group_text');
        $group_name = trim($group_name);
        $coreuser_update = new CoreMember(); 
        $core = CorePermissionRelMember::findFirstByRelMemberId($id);
        $coreuser_update = CoreMember::findFirstByMemberId($id);
        $coreuser_update->user_rule = $group_id;
        $core->permission_group_id_user  = $group_id;        
        $core->permission_member_group_member_name = strtolower($group_name);
        $core->rel_permission_group_code     =  $group_name; 
        $coreuser_update->update();
        $core->update();
        $this->view->disable();
        $this->response->redirect('setting/index');
         }
        
         
        public function settingmoduleAction() {
           $UserList = new Db\CoreMember();
           $username = $UserList::getinstance()->getusername();
           $this->view->setVar("member", $username);
        }

}
