<?php

namespace workManagiment\Notification\Controllers;
use workManagiment\Leavedays\Models\Leaves as Leaves;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        
        $this->setCommonJsAndCss();
        
    }

    
    public function indexAction(){
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * get detail of the notification
     */
    public function detailAction() {
    $id= $this->request->get('data');
    $data= (explode(",",$id));
    $NotiDetail=new \workManagiment\Core\Models\Db\CoreMember();
    $noti=$NotiDetail->getdetail($data);
    $this->view->disable();
    echo json_encode($noti);
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Show All Notification in one page
     */
    public function viewallAction(){
        $All=new \workManagiment\Core\Models\Db\CoreMember();
        $all=$All->GetAdminNoti();
        $this->view->setVar('type', 'viewall');
        $this->view->setVar('all', $all);
    }
    
    /**
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * when user seen noti and click ok update data
     */
    public function update_notiAction(){
       $id = $this->request->get('id');
       $sdate = $this->request->get('start_date');
       $update=new \workManagiment\Core\Models\Db\CoreMember();
       $update->updateleave($id,$sdate);
    }
    
}

