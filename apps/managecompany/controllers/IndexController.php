<?php

namespace salts\Managecompany\Controllers;
use salts\Managecompany\Models\CompanyTbl;

//use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends ControllerBase {



    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
         $this->view->t = $this->_getTranslation();
        $this->assets->addJs('apps/managecompany/js/index.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        
    }
    /**
     * show manage company page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function indexAction(){
        $comid=$this->request->get('comlistsearch');
       $company=new \salts\Managecompany\Models\CompanyTbl();
       $result=  $company->getallcom();
       if(isset($comid)){
           $result=  $company->findCombyId($comid);
       }
       $this->view->result=$result;
       

    }
    
  
    /**
     * show addcompany page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function addcompanyAction(){
       $coremodule=new \salts\Managecompany\Models\CoreModule();
       $module_list=$coremodule->getallmodule();
       $this->view->module_list=$module_list;
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
         $coremodule=new \salts\Managecompany\Models\CoreModule();
       $module_list=$coremodule->getallmodule();
       $this->view->module_list=$module_list;
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
   
public function confirmAction(){
     $pass = $this->request->get('pass');
     $message="Invalid";
     if($this->session->user['password']==sha1($pass)){
         $message="success";
     }
     
          echo json_encode($message);
        $this->view->disable();
}

    
}
