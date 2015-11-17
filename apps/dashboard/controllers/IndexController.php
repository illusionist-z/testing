<?php

namespace workManagiment\Dashboard\Controllers;
use workManagiment\Core\Models\Db;
use Phalcon\Flash\Direct as FlashDirect;
class IndexController extends  ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/btn.js');
        //$this->assets->addJs('apps/dashboard/js/index.js');    
        $this->assets->addCss('common/css/css/style.css');
        $this->assets->addCss('common/css/boot.css');
        $this->permission = $this->setPermission();        
    }
 /**
     * 
     *Check User or Admin 
     */
    public function indexAction() {
        //$this->aa();exit;
        
        foreach ($this->session->auth as $key_name => $key_value) {
             
            if ($key_name == 'user_dashboard') {
                //Go to user dashboard
                $this->view->disable();
                $this->response->redirect('dashboard/index/user');
            } 
            if ($key_name == 'admin_dashboard') {
                //Go to admin dashboard
                $this->view->disable();
                $this->response->redirect('dashboard/index/admin');
            }
        }
    }
    /**
     * show admin dashboard
     * @author david
     * get last created member name
     * @type array {$gname}
     */
    public function adminAction() { 
    $this->assets->addJs('common/js/time.js');
    //echo $this->permission;exit;
    $Admin=new Db\CoreMember;
    $id=$this->session->user['member_id'];
    $noti=$Admin->GetAdminNoti($id);
    $this->view->setVar("noti",$noti);
    //get last create member
    $CMember = new Db\CoreMember();
    $GetName = $CMember::getinstance()->getlastname();
    $newmember = count($GetName);
    //get most leave name
    $CheckLeave = new \workManagiment\Dashboard\Models\Attendances();
    $leave_name =$CheckLeave->checkleave();
    $status     =$CheckLeave->todayattleave();
    
    if($this->permission==1 && $this->session->permission_code=='ADMIN'){
    $this->view->setVar("attname",$status['att']);
    $this->view->setVar("absent",$status['absent']);
    $this->view->setVar("nlname",$leave_name['noleave_name']);  //get current month no taken leave name
    $this->view->setVar("lname",$leave_name['leave_name']);
    $this->view->setVar("name",$GetName);
    $this->view->setVar("newnumber",$newmember);
    $this->view->t = $this->_getTranslation();
        }
        else {
            $this->response->redirect('core/index');
        }  
    
    }
    
    /**
     * show user dashboard
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * 
     */
    public function userAction() {
        $this->assets->addJs('common/js/time.js');
        $User=new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $noti=$User->GetUserNoti($id);
        $this->view->setVar("noti",$noti);
        $Attendances = new \workManagiment\Dashboard\Models\Attendances();
        $numofatt=$Attendances->getattlist($id);
        $numofleaves=$Attendances->gettotalleaves($id);
        if($this->permission == 1){
        $this->view->setVar("numatt",$numofatt);
        $this->view->setVar("numleaves",$numofleaves);
        $this->view->t = $this->_getTranslation();
        }
        else{
            $this->response->redirect('core/index');
        }
    }
    /**
     * set location,latitude and longitude to session
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function location_sessionAction() {
        $lat = $this->request->get('lat');
        $lng = $this->request->get('lng');
        $offset = $this->request->get('offset');
        $this->session->set('location', array(
            'lat' => $lat,
            'lng' => $lng,
            'offset' => $offset
        ));
    }
    
    /**
     * Check In Action
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
     public function checkinAction() {
         $User=new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $note = $this->request->get('note');
        $lat = $this->session->location['lat'];
        $lon = $this->session->location['lng'];
        $noti_Creatorid=$User->GetAdminstratorId();
        $creator_id=$noti_Creatorid[0]['rel_member_id'];
        //get user location using lat and log
          if(0==$lon && 0==$lat){
               $add="-";
               
                }
                else{
                $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lon).'&sensor=false';
                $json = @file_get_contents($url);
                $data=json_decode($json);
                if( isset($data->results[5]->formatted_address)){
                $add= $data->results[5]->formatted_address;
                }
                else
                {
                   $add="-";
                }
                
                }
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $status=$checkin->setcheckintime($id, $note, $lat, $lon,$add,$creator_id);
        echo "<script>alert('".$status."');</script>";
       echo "<script type='text/javascript'>window.location.href='direct';</script>";
     }
    /**
     * Check out
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
   public function checkoutAction() {
        $id = $this->session->user['member_id'];
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $status=$checkin->setcheckouttime($id);
        echo "<script>alert('".$status."');</script>";
        echo "<script type='text/javascript'>window.location.href='direct';</script>";
    }
    
    /**
     * define user or admin
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function directAction(){
        $name=$this->session->permission_code;
       if ( $name=='ADMIN'){
            $this->response->redirect('attendancelist/index/todaylist');
        }
        else
        {
            $this->response->redirect('attendancelist/user/attendancelist');
        }
    }
    


    
}
