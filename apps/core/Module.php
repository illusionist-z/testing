<?php

namespace salts\Core; 

class Module extends \Library\Core\Module implements \Phalcon\Mvc\ModuleDefinitionInterface {

    public function __construct() {
        parent::__construct(__DIR__);
    }

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di = null) {
        parent::registerAutoloaders();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices(\Phalcon\DiInterface $di) {
        /**
         * Read configuration
         */
        parent::registerServices($di);
    }

}
