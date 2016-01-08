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
    
    public function indexAction(){
       $company=new \salts\Managecompany\Models\CompanyTbl();
     $result=  $company->getallcom();
       $this->view->result=$result;
       

    }
    
    public function addcompanyAction(){
        
    }
    
    public function editcompanyAction(){
         $id=$this->request->get('id');
         $company=new \salts\Managecompany\Models\CompanyTbl();
        $result=$company->findDatabyId($id);
        $this->view->result=$result;
    }
    
    public function addnewAction(){
        $com=$this->request->get('com');
        $check=$this->request->get('check');
        $company=new \salts\Managecompany\Models\CompanyTbl();
        $company->addnew($com,$check);
        $this->response->redirect("managecompany/index");

    }
    
    public function updatecompanyAction(){
          $com=$this->request->get('com');
        $company=new \salts\Managecompany\Models\CompanyTbl();
        $company->updatecom($com);
                $this->response->redirect("managecompany/index");
    }
   

    
}
