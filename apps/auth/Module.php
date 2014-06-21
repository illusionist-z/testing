<?php namespace Crm\Auth;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module extends \Lib\Core\Module implements ModuleDefinitionInterface
{

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
        /**
         * Read configuration
         */
        parent::registerServices($di);

    }

}
