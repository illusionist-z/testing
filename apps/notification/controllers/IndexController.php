<?php

namespace workManagiment\Notification\Controllers;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
  
        
    }
    
    public function detailAction() {
    $id= $this->request->get('data');
    $NotiDetail=new \workManagiment\Core\Models\Db\CoreMember();
    $noti=$NotiDetail->getdetail($id);
    $this->view->setVar('type', 'detail');
    $this->view->setVar('detail', $noti);
    }
    
    public function viewallAction(){
        $All=new \workManagiment\Core\Models\Db\CoreMember();
        $all=$All->GetAdminNoti();
        $this->view->setVar('type', 'viewall');
         $this->view->setVar('all', $all);
    }
   
}

