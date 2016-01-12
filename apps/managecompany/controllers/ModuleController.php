<?php


namespace salts\Managecompany\Controllers;


class ModuleController extends ControllerBase {
    
    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->view->t = $this->_getTranslation();
        $this->assets->addJs('apps/managecompany/js/module.js');
        $this->assets->addCss('common/css/css/style.css');
   $this->assets->addCss('common/css/dialog.css');

       
        
    }
    
    public function indexAction(){
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result = $Obj->getallmodule();
        $this->view->result=$result;
    }
    
    public function add_moduleAction(){
        $data['mid'] = $this->request->getPost('mid');
        $data['mname'] = $this->request->getPost('mname');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->addnewmodule($data);
    }
    
    public function editmoduleAction(){
        $id = $this->request->get('id');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result=$Obj->getmodulebyId($id);
        echo json_encode($result);
        $this->view->disable();
    }
    
    public function updatemoduleAction(){
        $id = $this->request->get('id');
        $mname = $this->request->get('mname');
         $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->UpdateModuleById($id,$mname);
    }
    
    
}