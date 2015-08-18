<?php

namespace workManagiment\Dashboard\Controllers;
use workManagiment\Core\Models\Db;
use Phalcon\Flash\Direct as FlashDirect;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
        
    }
 /**
     * 
     *Check User or Admin 
     */
    public function indexAction() {
        foreach ($this->session->auth as $key_name => $key_value) {
             
            if ($key_name == 'user_dashboard') {
                //Go to user dashboard
                $this->view->disable();
                $id = $this->session->user['member_id'];
                $user=new Db\CoreMember;
                $noti=$user->GetUserNoti($id);
                
                $this->session->set('noti', $noti);
                
                $this->response->redirect('dashboard/index/user');
              
            } 
            if ($key_name == 'admin_dashboard') {
                //Go to admin dashboard
                $this->view->disable();
                $admin=new Db\CoreMember;
                $noti=$admin->GetAdminNoti();
                $this->session->set('noti', $noti);
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
    //get last create member
    $cm = new Db\CoreMember();
    $gname = $cm::getinstance()->getlastname();
    $newmember = count($gname);
    //get most leave name
    $checkleave = new \workManagiment\Dashboard\Models\Attendances();
    $leave_name =$checkleave->checkleave();
    $status     =$checkleave->todayattleave();
    $this->view->setVar("attname",$status['att']);
    $this->view->setVar("absent",$status['absent']);
    $this->view->setVar("nlname",$leave_name['noleave_name']);  //get current month no taken leave name
    $this->view->setVar("lname",$leave_name['leave_name']);
    $this->view->setVar("name",$gname);
    $this->view->setVar("newnumber",$newmember);
    }
    
    /**
     * show user dashboard
     */
    public function userAction() {
          
    }

    /**
     * set location,latitude and longitude to session
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
     * Check in 
     */
    public function checkinAction() {
        
        $id = $this->session->user['member_id'];
        $note = $this->request->get('note');
        $lat = $this->session->location['lat'];
        $lon = $this->session->location['lng'];
       
          if(0==$lon && 0==$lat){
               $add="-";
                }
                else{
                $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lon).'&sensor=false';
                $json = @file_get_contents($url);
                $data=json_decode($json);
                if( $data){
                $add= $data->results[5]->formatted_address;
                }
                else
                {
                   $add="-";
                }
                }
                
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $status=$checkin->setcheckintime($id, $note, $lat, $lon,$add);
        $this->response->redirect('dashboard/index/direct');
       
        
        

        
        
    }

    /**
     * Check out
     */
    public function checkoutAction() {

        $id = $this->session->user['member_id'];
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $status=$checkin->setcheckouttime($id);
        
          $this->response->redirect('dashboard/index/direct');
       

    }
    public function directAction(){
        $name=$this->session->user['member_login_name'];
       if ( $name=='admin'){
            $this->response->redirect('attendancelist/index/todaylist');
        }
        else
        {
            $this->response->redirect('attendancelist/user/attendancelist');
        }
        
    }
    
    /**
     * Get timezone using lat & lang passing from js
     * @param type $latForGeo
     * @param type $lngForGeo
     * @return type
     */
    public function getTimezoneGeo($latForGeo, $lngForGeo) {
        
    $json = file_get_contents("http://api.geonames.org/timezoneJSON?lat=".$latForGeo."&lng=".$lngForGeo."&username=gnext");
    $data = json_decode($json);
    $tzone=$data->timezoneId;
     
    return $tzone;
}
    
}
