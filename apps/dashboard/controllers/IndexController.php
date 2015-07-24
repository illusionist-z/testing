<?php

namespace workManagiment\Dashboard\Controllers;
use workManagiment\Core\Models\Db;
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
    $cm = new Db\CoreMember();
    $gname = $cm::getinstance()->getlastname();
    //get most leave name
    $checkleave = new \workManagiment\Dashboard\Models\Attendances();
    $leave_name  =$checkleave->checkleave();
    $this->view->setVar("nlname",$leave_name['noleave_name']);
    $this->view->setVar("lname",$leave_name['leave_name']);
    $this->view->setVar("name",$gname);
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
        $tz=$this->getTimezoneGeo($lat,$lng);
      
        $this->session->set('location', array(
            'lat' => $lat,
            'lng' => $lng,
            'timezone' => $tz,
            'offset' => $offset
        ));
    
    }
    
    /**
     * Check in 
     */
    public function checkinAction() {
        $this->view->disable();
        $id = $this->session->user['member_id'];
        $note = $this->request->get('note');
        $lat = $this->session->location['lat'];
        $lon = $this->session->location['lng'];
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $checkin->setcheckintime($id, $note, $lat, $lon);
       
        
        

        
        
    }

    /**
     * Check out
     */
    public function checkoutAction() {

        $id = $this->session->user['member_id'];
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $checkin->setcheckouttime($id);
         //$this->response->redirect('attendancelist/user/attendancelist');
       

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
