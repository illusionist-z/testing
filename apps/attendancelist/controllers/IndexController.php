<?php
namespace workManagiment\Attendancelist\Controllers;
use workManagiment\Core\Models\Db;
class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/paging.js');
        $this->assets->addJs('common/js/export.js');                         
        $this->assets->addJs('apps/attendancelist/js/index.js');
        $this->assets->addCss('apps/attendancelist/css/index.css');        
        //$this->assets->addJs('apps/attendancelist/js/search-attsearch.js');
        $this->config = \Module_Config::getModuleConfig('leavedays');
        $this->assets->addCss('common/css/css/style.css');
    }   

   /**
    * show today attendance list
    */    
    public function todaylistAction() {
        $Admin=new Db\CoreMember;
        $noti=$Admin->GetAdminNoti();
        $this->view->setVar("noti",$noti);
        $name = $this->request->get('namelist');
        $offset= $this->session->location['offset'];          
        //get user name
        //$userlist= new \workManagiment\Attendancelist\Models\CoreMember();
        $UserList=new Db\CoreMember();
        $Username = $UserList::getinstance()->getusername();        
        $AttList = new \workManagiment\Attendancelist\Models\Attendances(); 
        $ResultAttlist = $AttList->gettodaylist($name);        
        $this->view->attlist=$ResultAttlist;
        $this->view->offset= $offset;
        $this->view->uname = $Username;
        $this->view->t = $this->_getTranslation();
    }    
  
    /**
     * Show monthly attendance list
     */
    public function monthlylistAction() {
       $Admin=new Db\CoreMember;
        $noti=$Admin->GetAdminNoti();
        $this->view->setVar("noti",$noti);
        $offset= $this->session->location['offset'];
        $UserList=new Db\CoreMember();
        $UserName = $UserList::getinstance()->getusername();
        $month = $this->config->month;                
        $Attendances = new \workManagiment\Attendancelist\Models\Attendances();
        $monthlylist = $Attendances->showattlist();
        //print_r($monthlylist);exit;
        $this->view->monthlylist = $monthlylist;
        $this->view->setVar("Month", $month);        
        $this->view->setVar("Getname", $UserName);                
        $this->view->offset=$offset;
    }  
    
     public function autolistAction() {
//         $name = $this->request->get('namelist');          
//        //$offset= $this->session->location['offset'];
//        $Attendances=new Attendances();
//        $result=$Attendances->gettodaylist($name);
//        print_r($result);exit;
//        $this->view->disable();    
        
        //echo json_encode($result);
         $UserList=new Db\CoreMember();
        $Username = $UserList->autousername(); 
       // print_r($UserList);exit;
        $this->view->disable();    
        echo json_encode($Username);
//        
//        $name = $this->request->get('namelist');
//       // echo $name;exit;
////        $offset= $this->session->location['offset'];          
//        //get user name
//        //$userlist= new \workManagiment\Attendancelist\Models\CoreMember();
//        $UserList=new Db\CoreMember();
//        $Username = $UserList::getinstance()->getusername();        
//       $AttList = new \workManagiment\Attendancelist\Models\Attendances(); 
//       $ResultAttlist = $AttList->gettodaylist($name);
//           // print_r($ResultAttlist);exit;
//        $this->view->disable();       
//        echo json_encode($ResultAttlist);
        
       
    } 
}

