<?php
namespace salts\Setting\Controllers;
use salts\Setting\Models\CorePermissionGroup;
use salts\Setting\Models\CorePermissionGroupId;
use salts\Setting\Models\CorePermissionRelMember;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;
use Phalcon\Filter;  
/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setSettJsAndCss();
        $this->config = \Library\Core\Models\Config::getModuleConfig('leavedays');
        $this->module_name = $this->router->getModuleName();
        $this->act_name = $this->router->getActionName();
        $this->permission = $this->setPermission($this->act_name);
         $this->view->module_name = $this->module_name;
        $this->view->permission = $this->permission;
        $moduleIdCallCore = new Db\CoreMember();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name, $this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
         
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @desc    $core_group = {}
     * @Version  Yan Lin Pai <wizardrider@gmail.com>
     * @desc    $core_groupid = {}
     * @desc    $core_user = {}
     */
    
   public function indexAction() {
            $this->response->redirect('core/index');
    }
    public function adminAction() {
        if ($this->permission == 1) {
          $permission = new \salts\Core\Models\Permission();
            $coreid = new CorePermissionGroupId();
            $corememberid = new CorePermissionRelMember();
            $coreuser = new CoreMember();            
            $coreuser2 = new CorePermissionGroup();
            $currentPage  = $this->request->get("page");
            $currentPage1  = $this->request->get("page1");
            $core_groupid = $coreid::find();
            $coremember = $corememberid::find();
            $core_groupuser22 = $coreuser2::find();
            $core_groupuser2 = $permission->pagination($core_groupuser22,$currentPage);
            $core_groupuser = $coreuser->getGroupId($currentPage1);
            //for paging without reload
            if($this->request->has("type")){
                $type = $this->request->get("type");
                if($type == "page"){
                    $group_id = [$core_groupid->toArray(),$core_groupuser2];
                    echo json_encode($group_id);
                }
                elseif ($type == "user"){
                    $group_id = [$core_groupid->toArray(),$core_groupuser];
                    echo json_encode($group_id);
                }
                $this->view->disable();                
            }
            $this->view->coreid = $core_groupid;
            $this->view->coremember = $coremember;
            $this->view->coreuser = $core_groupuser;
            $this->view->coreuser2 = $core_groupuser2;            
            $id = $this->session->user['member_id'];
            $Noti = $coreuser->getAdminNoti($id, 0);
            $this->view->setVar("noti", $Noti);
        } else {
            $this->response->redirect('core/index');
        }
    }

    /**
     * @author Yan Lin Pai <wizardrider@gmail.com>
     * @desc    $core = {}
     * @public function 4 set
     */
    public function AddGroupRuleAction() {
        $core = new CorePermissionGroupId();
        $core->save($this->request->getPost());
        $this->view->disable();
        $this->response->redirect('setting/index/admin');
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @option[] - return array
     */
    public function AddPageRuleAction() {
         
        $filter = new Filter();
        $creator_id = $filter->sanitize($this->session->user['member_id'],'string');
        $created_dt = date("Y-m-d H:i:s");
        $core = new CorePermissionGroup();
        $option = explode("_", $this->request->getPost('page_rule_group'));
        $core->page_rule_group = $option[0];
        $core->permission_group_code = $option[1];
        $core->permission_group_name = strtolower($option[1]);
        $core->creator_id = $creator_id;
        $core->created_dt = $created_dt;
        $core->permission_code = $this->request->getPost('permission_code');
        $core->save();
        $this->view->disable();
        $this->response->redirect('setting/index/admin');
    }

    public function DelGroupRuleAction() {
        
        $core = CorePermissionGroupId::Find($this->request->getPost('group_id'));
        $core->delete();
        $this->view->disable();
    }

    /**
     * @author YanLin Pai <wizardrider@gmail.com>
     * @DelPageRuleAction
     */
    public function DelPageRuleAction() {
        //$core = new CorePermissionGroup();
        $core = CorePermissionGroup::Find($this->request->getPost('idpage'));
        $core->delete();
        $this->view->disable();
    }

    public function GroupRuleSettingAction() {
         
        $filter = new Filter();
        $group_name = $filter->sanitize($this->request->getPost('name_of_group'),'string');
         
        $core = CorePermissionGroupId::findFirst('group_id =' . $this->request->getPost('group_id'));
        $core->name_of_group = strtoupper($group_name);
        $core->update();
        $this->view->disable();
        $this->response->redirect('setting/index/admin');
    }

    /**
     * @author Yan Lin Pai <wizardrider@gmail.com>
     * @desc    $core = {}
     * @public function 4 set
     */
    
    public function User2RuleSettingAction() {
         
        $filter = new Filter();
        $idpage =$filter->sanitize($this->request->getPost('idpage'),'string'); 
        $page_rule_group = $filter->sanitize($this->request->getPost("page_rule_group"),'string');
        $permission_code = $this->request->getPost("permission_code"); 
       
        $core = CorePermissionGroup::findFirst('idpage=' .$idpage);
        $core->idpage = $idpage;
        $core->page_rule_group = $page_rule_group;
        $core->permission_code = $permission_code;
        $update = $core->update();
        //$success = $core->corePermissionUpdate($idpage, $page_rule_group, $permission_code);  //updating field permission
        if ($update) {
            $this->view->disable();
            $this->response->redirect('setting/index/admin');
        } else {
            echo "Failed!!";
        }
    }

    public function UserRuleSettingAction() {
      
        $id = $this->request->getPost('rel_member_id');
        $group_id = $this->request->getPost('group_id');
        $group_name_post = $this->request->getPost('group_text');
        $group_name = trim($group_name_post);
         
        $core = CorePermissionRelMember::findFirstByRelMemberId($id);
        $coreuser_update = CoreMember::findFirstByMemberId($id);
        $coreuser_update->user_rule = $group_id;
        $core->permission_group_id_user = $group_id;
        $core->permission_member_group_member_name = strtolower($group_name);
        $core->rel_permission_group_code = $group_name;
        $coreuser_update->update();
        $core->update();
        $this->view->disable();
        $this->response->redirect('setting/index/admin');
    }

    public function SettingModuleAction() {
        $UserList = new Db\CoreMember();
        $username = $UserList::getinstance()->getUserName();
        $this->view->setVar("member", $username);
    }

}
