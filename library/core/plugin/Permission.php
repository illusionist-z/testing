<?php namespace Library\Core\Plugin;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Phalcon\Events\Event,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Acl;

class Permission extends Plugin
{
    public function __construct($dependencyInjector)
    {
        $this->_dependencyInjector = $dependencyInjector;
    }
    
    /**
     * This action is executed before execute any action in the application
     * 
     * @author Kohei Iwasa
     * @since 2014/06/21
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        // Use memory For ACL(Access Controll List)
        $acl = new Acl\Adapter\Memory();
        
        // Default action is deny access
        $acl->setDefaultAction(Acl::DENY);
        if( 
            NULL === $this->session->get('auth')
            &&  $dispatcher->getModuleName() !== 'auth'
        ){  
            $this->response->redirect('auth');
            return;
        }

    }
    
    function test(){
        return 'X';
    }
}