<?php 
namespace Workmanagements\Frontend\Controllers;

use Lib;

class ControllerBase extends Lib\Core\Controller
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
