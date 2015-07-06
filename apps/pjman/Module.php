<?php namespace Crm\Pjman;


class Module extends \Lib\Core\Module implements \Phalcon\Mvc\ModuleDefinitionInterface
{
    /**
     * constructor
     */
    public function __construct() {
        parent::__construct(__DIR__);
    }
    
    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {
        parent::registerAutoloaders();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices($di)
    {
        parent::registerServices($di);
    }

}
