<?php

class UsersController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Gnext attendance system');
        parent::initialize();
    }

    public function indexAction()
    {
        
    }


}
