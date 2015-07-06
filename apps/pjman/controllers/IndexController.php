<?php

namespace Crm\Pjman\Controllers;

//use Crm\Todo\Models;

class IndexController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        
        //set duser info
        $this->view->user = $this->session->get('user');
        $this->view->tran = $this->_getTranslation();
        
    }

    /**
     * index Action Controller
     * 
     */
    public function indexAction(){
        // if you need slide menu , set bellow
        $this->useSlideMenu();
        
//        // set js and css for this module.
//        $this->assets->addCss('css/user/user.css');
//        $this->assets->addJs('js/user/user.js'); 
//           
//        //set dept list
//        $this->view->depts = Models\Dept::getAll();
 
    }
    
}
