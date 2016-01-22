<?php

namespace salts\Managecompany\Controllers;
use salts\Managecompany\Models\CompanyTbl;

//use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends ControllerBase {



    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->view->t = $this->_getTranslation();
       // $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('apps/managecompany/js/index.js');
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/dialog.css');
        $moduleIdCallCore =new Db\CoreMember();
        $this->moduleIdCall = $moduleIdCallCore->ModuleIdSetPermission($this->module_name,$this->session->module);
        $this->view->moduleIdCall = $this->moduleIdCall;
    }
    /**
     * show manage company page
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function indexAction(){
        
        if ($this->moduleIdCall == 1)
       {
          $this->assets->addJs('common/js/paging.js');
          $this->assets->addJs('apps/managecompany/js/paging.js');
        $comid=$this->request->get('comlistsearch');
       $company=new \salts\Managecompany\Models\CompanyTbl();
       $result=  $company->getallcom();
       if(isset($comid)){
           $result=  $company->findCombyId($comid);
       }
       $this->view->result=$result;
       
       }
       else {
            $this->response->redirect('core/index');
       }

    }
    
    public function getcomnameAction(){
        $company=new \salts\Managecompany\Models\CompanyTbl();
       $result=  $company->getallcom();
       echo json_encode($result);
       $this->view->disable();
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
        if ($this->request->isPost()) {
            $company=new \salts\Managecompany\Models\CompanyTbl();
             $validate = $company->validation($this->request->getPost());
             
            if(count($validate)){
               foreach ($validate as $message){
                   $json[$message->getField()] = $message->getMessage();
               }
               $json['result'] = "error";
                echo json_encode($json);
                $this->view->disable();
                  }     
            else{
             $com=$this->request->getPost();
        
       
        
        
        $error=$company->addnew($com);
         $this->view->disable();
            echo json_encode($error);
           
             }
        }
       

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
   
    /**
     *  @author Su Zin Kyaw <gnext.suzin@gmail.com>
     *  Confirm Login User Password to see selected company db pass
     */
    public function confirmAction(){
         $pass = $this->request->get('pass');
         $message="Invalid";
         if($this->session->user['password']==sha1($pass)){
             $message="success";
         }

              echo json_encode($message);
            $this->view->disable();
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Delete Selected Company By Id
     */
    public function deletecompanyAction(){
        $id = $this->request->get('id');
        $company=new \salts\Managecompany\Models\CompanyTbl();
        $company->deleteCompanyById($id);
        $this->response->redirect("managecompany/index");
    }

    
}
