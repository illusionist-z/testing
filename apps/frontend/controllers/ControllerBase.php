<?php namespace workManagiment\Frontend\Controllers;

use Library;

class ControllerBase extends Library\Core\Controller
{
    /**
     * temp 
     * @var type 
     */
    
    public function initialize() {
//        $this->session->set('index', 3);
        if(null !== $this->session->get('index')){
            $session = $this->session->get('index');
        }else{
            $session = 'B';
        }
        
        echo $this->session->get('index');
//       $session $this->session->set('index',3);
        
    }
}
