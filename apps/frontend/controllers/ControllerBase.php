<?php

namespace salts\Frontend\Controllers;

class ControllerBase extends \Library\Core\Controller {

    /**
     * temp 
     * @var type 
     */
    public function initialize() {
        if (null !== $this->session->get('index')) {
            $session = $this->session->get('index');
        } else {
            $session = 'B';
        }
        echo $this->session->get('index');
    }

}
