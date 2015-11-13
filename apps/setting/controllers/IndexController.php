<?php

use Phalcon\Config;

use Phalcon\Mvc\Url as UrlProvider;

namespace workManagiment\Setting\Controllers;
use workManagiment\Setting\Models\CorePermissionGroup; 
use workManagiment\Setting\Models\CorePermissionGroupId; 
use workManagiment\Setting\Models\CorePermissionRelMember; 
use workManagiment\Core\Models\Db\CoreMember;
use Phalcon\Http\Response;

    
class IndexController extends ControllerBase {

   public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
         
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');  
        //$this->assets->addJs('common/js/bootstrap.min.js');  
        //$this->assets->addJs('common/js/app.min.js'); 
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
        $core = new CorePermissionGroup();
        $coreid = new CorePermissionGroupId(); 
        $coreuser = new CoreMember(); 
        
        $core_group=$core::find();
        
        $core_groupid=$coreid::find();
         
        $core_groupuser=$coreuser->getgroupid();         
        $this->view->core = $core_group;
        $this->view->coreid = $core_groupid;
        $this->view->coreuser = $core_groupuser;
         
  }     
 
 
         /**
        * @author Yan Lin Pai <wizardrider@gmail.com>
        * @desc    $core = {}
        */
        public function AddGroupRuleAction()
        {
        $core = new CorePermissionGroupId();
        $core->save($this->request->getPost());
        //var_dump($core);exit;
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
        

         public function PageRuleSettingAction()
        {
        $corepage = new CorePermissionGroup();
        $corepage->save($this->request->getPost());
        //var_dump($core);exit;
        $this->view->disable();
        $this->response->redirect('setting/index/index');
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
        public function editAction()
        {
         
        }

        /**
        * Creates a product based on the data entered in the "new" action
        */
        public function createAction()
        {
        // ...
        }

        /**
        * Updates a product based on the data entered in the "edit" action
        */
        public function saveAction()
        {
           // ...
        }

        /**
        * Deletes an existing product
        */
        public function deleteAction()
        {
           // ...
        }

        public function settingmoduleAction() {
           $UserList = new Db\CoreMember();
           $username = $UserList::getinstance()->getusername();
           $this->view->setVar("member", $username);
        }

}
