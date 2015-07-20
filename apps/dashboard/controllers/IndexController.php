<?php

namespace workManagiment\Dashboard\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
        
    }

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
     */
    public function adminAction() {
    
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
