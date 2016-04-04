<?php

namespace salts\Managecompany\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->setCompanyJsAndCss();
        $this->view->t = $this->_getTranslation();
    }

    /**
     * show manage company page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function indexAction() {


        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/managecompany/js/base.js');
        $com_id = $this->request->get('comlistsearch');
        $Company = new \salts\Managecompany\Models\CompanyTbl();
        $result = $Company->find();
        if (isset($com_id)) {
            $result = $Company->find("company_id = '$com_id' ");
        }
        $this->view->result = $result;
    }

    public function getcomnameAction() {
        $Company = new \salts\Managecompany\Models\CompanyTbl();
        $result = $Company->getAllcom();
        echo json_encode($result);
        $this->view->disable();
    }

    /**
     * show addcompany page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function addcompanyAction() {
        $CoreModule = new \salts\Managecompany\Models\CoreModule();
        $module_list = $CoreModule->getAllmodule();
        $this->view->module_list = $module_list;
    }

    /**
     * show company detail to edit
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editcompanyAction() {
        $id = $this->request->get('id');
        $Company = new \salts\Managecompany\Models\CompanyTbl();
        $result = $Company->findDatabyId($id);
        $EnableModule = new \salts\Core\Models\EnableModule();
        $module = $EnableModule->find("company_id = '$id' ");
        $CoreModule = new \salts\Managecompany\Models\CoreModule();
        $module_list = $CoreModule->find();
        $this->view->module_list = $module_list;
        $this->view->module = $module;
        $this->view->result = $result;
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Add new company 
     */
    public function addnewAction() {
        if ($this->request->isPost()) {
            $Company = new \salts\Managecompany\Models\CompanyTbl();
            $validate = $Company->validation($this->request->getPost());

            if (count($validate)) {
                foreach ($validate as $message) {
                    $json[$message->getField()] = $message->getMessage();
                }
                $json['result'] = "error";
                echo json_encode($json);
                $this->view->disable();
            } else {
                $com = $this->request->getPost();
                $error = $Company->addNew($com);
                $this->view->disable();
                echo json_encode($error);
            }
        }
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Update Company Detail with new data
     */
    public function updatecompanyAction() {
        $com = $this->request->get('com');
        $check = $this->request->get('check');

        $Company = new \salts\Managecompany\Models\CompanyTbl();
        $Company->updateCom($com, $check);
        $this->response->redirect("managecompany/index");
    }

    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  Confirm Login User Password to see selected company db pass
     */
    public function confirmAction() {
        $pass = $this->request->get('pass');
        $message = "Invalid";
        if ($this->session->user['password'] == sha1($pass)) {
            $message = "success";
        }

        echo json_encode($message);
        $this->view->disable();
    }

    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Delete Selected Company By Id
     */
    public function deletecompanyAction() {
        $id = $this->request->get('id');
        $Company = new \salts\Managecompany\Models\CompanyTbl();
        $data = $Company->find("company_id = '$id' ");
        $data->delete();
        $this->response->redirect("managecompany/index");
    }

}
