<?php

namespace workManagiment\Dashboard\Controllers;

class IndexController extends ControllerBase {

    public function initialize() {
        parent::initialize();

        $this->setCommonJsAndCss();
        $this->assets->addJs('common/js/time.js');
        $this->assets->addJs('common/js/btn.js');
        //$this->assets->addJs('apps/home/js/geo.js');
    }

    public function indexAction() {
        //$this->assets->addCss('common/css/home/home.css');             
    }

    public function location_sessionAction() {
        $lat = $this->request->get('lat');
        $lng = $this->request->get('lng');
        $this->session->set('location', array(
            'lat' => $lat,
            'lng' => $lng
        ));
    }

    public function checkinAction() {                
        $id = $this->session->user['member_id'];
        $note = $this->request->get('note');
        $lat = $this->session->location['lat'];
        $lon = $this->session->location['lng'];
        $checkin = new \workManagiment\Dashboard\Models\Attendances();
        $checkin->setcheckintime($id, $note, $lat, $lon);
        
        
    }
   
    public function checkoutAction(){
        
       $id= $this->session->user['member_id'];
       $checkin=new \workManagiment\Dashboard\Models\Attendances();
       $checkin->setcheckouttime($id);
      
    }

}
