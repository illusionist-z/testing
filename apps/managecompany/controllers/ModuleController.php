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
    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  show module List
     */
    public function indexAction(){
        $id=$this->request->get("msearch");
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result = $Obj->getallmodule();
        if(isset($id)){
            $result=$Obj->search($id);
        }
        
        
        $this->view->result=$result;
    }
    
    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  Add new module 
     */
    public function add_moduleAction(){
        $data['mid'] = $this->request->getPost('mid');
        $data['mname'] = $this->request->getPost('mname');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->addnewmodule($data);
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * show selected module detail via dialog box
     */
    public function editmoduleAction(){
        $id = $this->request->get('id');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result=$Obj->getmodulebyId($id);
        echo json_encode($result);
        $this->view->disable();
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Update Module data by module id
     */
    public function updatemoduleAction(){
        $id = $this->request->get('id');
        $mname = $this->request->get('mname');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->UpdateModuleById($id,$mname);
    }
    
    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  Delete Selected Module By module Id
     */
    public function deletemoduleAction(){
        $id = $this->request->get('id');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->DeleteModuleById($id);
    }
    
    
}