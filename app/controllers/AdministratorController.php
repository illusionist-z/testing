<?php
class AdministratorController extends ControllerBase
{
    public function initialize()
    {
        //$this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Gnext attendance system');
        parent::initialize();
        if(!isset($this->session->auth['user_role'])){
            header ("Location: ../index");
            }
    }

    public function indexAction()
    {
          
    
    }
    public function settingAction()
    {
         $users=new Users();
         $result=$users->getpermissiongp();
        
         $this->view->setVar("Result", $result);
    }
    
    public function showmoduleAction()
    {
        $users=new Users();
        $aa=$this->request->get("cname");
        //echo $aa."test";exit;
      // set up check box data
        $allPermission=$users->getallpermission();
        
        $aryAllPermission = array();
        foreach($allPermission as $v){
            $_module = $v['module_id'];
            $_code = $v['permission_code'];
            $checked = isset($enablePermission[$_module][$_code]) ? 1 : 0;
            $aryAllPermission[] = array(
                'permission_code' => $_code,
                'permission_name' => $v['permission_name'],
                'checked' => $checked,
            );
        }
       print_r($aryAllPermission);
        //$this->view->setVar("aryAllPermission", $aryAllPermission);
       $this->view->disable();
       
      //return $aryAllPermission;
    //echo json_encode($aryAllPermission);
    }
}
