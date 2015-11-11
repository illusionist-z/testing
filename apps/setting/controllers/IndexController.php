<?php

use Phalcon\Config;

use Phalcon\Mvc\Url as UrlProvider;

namespace workManagiment\Setting\Controllers;
use workManagiment\Setting\Models\CorePermissionGroup; 
use workManagiment\Setting\Models\CorePermissionGroupId;
use workManagiment\Setting\Models\CoreMember;
use workManagiment\Core\Models\Db;

    
class IndexController extends ControllerBase {

   public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
         
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/css/style.css');  
        //$this->assets->addJs('common/js/bootstrap.min.js');  
        //$this->assets->addJs('common/js/app.min.js'); 
        //$this->assets->addJs('common/js/common.js'); 
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
         
        $core_groupuser=$coreuser::find();
         
        $this->view->core = $core_group;
        $this->view->coreid = $core_groupid;
        $this->view->coreuser = $core_groupuser;
         
  }     
        
  
// ...

// Setup a base URI so that all generated URIs include the "tutorial" folder
          
        /**
        * Execute the "search" based on the criteria sent from the "index"
        * Returning a paginator for the results
        */
        public function GroupRuleSettingAction()
        {
        $core = new CorePermissionGroupId();
        $core->save($this->request->getPost());        
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
