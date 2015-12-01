<?php

use Phalcon\Config;
use Phalcon\Mvc\Url as UrlProvider;

namespace workManagiment\Setting\Controllers;
use workManagiment\Setting\Models\CorePermissionGroup; 
use workManagiment\Setting\Models\CorePermissionGroupId; 
use workManagiment\Setting\Models\CorePermissionRelMember; 
use workManagiment\Core\Models\Db\CoreMember;
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

 }
    
    
        /**
        * @author David JP <david.gnext@gmail.com>
        * @desc    $core_group = {}
        * @Cover  Yan Lin Pai <wizardrider@gmail.com>
        * @desc    $core_groupid = {}
        * @desc    $core_user = {}
        */
        public function indexAction() {     
        
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
        $this->response->redirect('setting/index/index');
        }
        /**
         * @author David JP <david.gnext@gmail.com>
         * @option[] - return array
         */
         public function AddPageRuleAction()
        {
        $core = new CorePermissionGroup();
        $option = explode("_",  $this->request->getPost('page_rule_group'));
        $core->page_rule_group = $option[0];
        $core->permission_group_code = $option[1];
        $core->permission_group_name = strtolower($option[1]);
        $core->permission_code = $this->request->getPost('permission_code');
        $core->save();
        $this->view->disable();
        $this->response->redirect('setting/index/index');
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
        $this->response->redirect('setting/index/index');
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
                $this->response->redirect('setting/index/index');
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
        $core = CorePermissionRelMember::findFirstByRelMemberId($id);
        $core->permission_group_id_user  = $group_id;        
        $core->permission_member_group_member_name = strtolower($group_name);
        $core->rel_permission_group_code     =  $group_name;         
        $core->update();
        $this->view->disable();
        $this->response->redirect('setting/index/index');
         }
        /**
        * Shows the view to create a "new" product
        *       
        * Shows the view to "edit" an existing product
        */
 
        /**
        * Creates a product based on the data entered in the "new" action
        */
 
         
        /**
        * Updates a product based on the data entered in the "edit" action
        */
        
        /**
        * Deletes an existing product
        */
        
        public function settingmoduleAction() {
           $UserList = new Db\CoreMember();
           $username = $UserList::getinstance()->getusername();
           $this->view->setVar("member", $username);
        }

}
