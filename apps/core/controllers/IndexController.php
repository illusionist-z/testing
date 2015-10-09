<?php

namespace workManagiment\Core\Controllers;

use Library;

class IndexController extends Library\Core\Controller {

    public function initialize() {
        parent::initialize();
    }
    public function  indexAction(){
         $this->setCommonJsAndCss();

    }
      
     public function setLanguageAction($language='')
    {  
        //Change the language, reload translations if needed        
        $this->session->set('language', $language);

        //Go to the last place
        $referer = $this->request->getHTTPReferer();
        if (strpos($referer, $this->request->getHttpHost() . "/") !== false) {
            return $this->response->setHeader("Location", $referer);
        } else {
            return $this->dispatcher->forward(array('controller' => 'index', 'action' => 'index'));
        }
    }

}
