<?php

namespace salts\Managecompany\Controllers;
use salts\Managecompany\Models\CompanyTbl;

//use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends ControllerBase {



    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->view->t = $this->_getTranslation();
        $this->assets->addJs('apps/managecompany/js/multiple.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        
    }
    /**
     * show manage company page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function indexAction(){
       $company=new \salts\Managecompany\Models\CompanyTbl();
       $result=  $company->getallcom();
       $this->view->result=$result;
       

    }
    /**
     * show addcompany page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function addcompanyAction(){
        
    }
    /**
     * show company detail to edit
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function editcompanyAction(){
        $id=$this->request->get('id');
        $company=new \salts\Managecompany\Models\CompanyTbl();
        $result=$company->findDatabyId($id);
        $module=$company->findModulebyId($id);
        $this->view->module=$module;
        $this->view->result=$result;
    }
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Add new company 
     */
    public function addnewAction(){
        $com=$this->request->get('com');
        $check=$this->request->get('check');
        $company=new \salts\Managecompany\Models\CompanyTbl();
        $company->addnew($com,$check);
        $this->response->redirect("managecompany/index");

    }
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Update Company Detail with new data
     */
    public function updatecompanyAction(){
        $com=$this->request->get('com');
        $check=$this->request->get('check');
        $company=new \salts\Managecompany\Models\CompanyTbl();
        $company->updatecom($com,$check);
        $this->response->redirect("managecompany/index");
    }
   

    
}
