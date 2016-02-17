<?php

namespace salts\Managecompany\Controllers;

class ModuleController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setCompanyModuleJsAndCss();
        $this->view->t = $this->_getTranslation();
    }

    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  show module List
     */
    public function indexAction() {
        $id = $this->request->get("msearch");
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result = $Obj->getAllmodule();
        if (isset($id)) {
            $result = $Obj->search($id);
        }
        $this->view->result = $result;
    }

    public function getmodulenameAction() {
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result = $Obj->getAllmodule();
        echo json_encode($result);
        $this->view->disable();
    }

    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  Add new module 
     */
    public function addmoduleAction() {
        $data['mid'] = $this->request->getPost('mid');
        $data['mname'] = $this->request->getPost('mname');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->adNewmodule($data);
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * show selected module detail via dialog box
     */
    public function editmoduleAction() {
        $id = $this->request->get('id');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $result = $Obj->getmodulebyId($id);
        echo json_encode($result);
        $this->view->disable();
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Update Module data by module id
     */
    public function updatemoduleAction() {
        $id = $this->request->get('id');
        $mname = $this->request->get('mname');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->updateModuleById($id, $mname);
    }

    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  Delete Selected Module By module Id
     */
    public function deletemoduleAction() {
        $id = $this->request->get('id');
        $Obj = new \salts\Managecompany\Models\CoreModule();
        $Obj->deleteModuleById($id);
    }

}
