<?php

namespace salts\Core; 
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher; 
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
        $di['view'] = function() {
			$view = new View();
			$view->setViewsDir('../../core/view/partials');
			$view->setLayoutsDir('../../core/view/partials');
			$view->setTemplateAfter('header');
			return $view;
		};
        parent::registerServices($di);
    }

}
