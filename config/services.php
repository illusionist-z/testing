<?php
/**
 * Services are globally registered in this file
 */
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a router
 */
$di->set('router', function () {
    $router = new Router();
    $def_mod = "frontend";
    $router->setDefaultModule($def_mod);
    
    $aryModules = \Library\Core\Module::get();
    
    // auth moduleの追加
    foreach ($aryModules as $module){
        if($def_mod === $module){
            continue;
        }
        
        $router->add('/'.$module, [
        'module' => $module,
            'action' => 'index',
            'params' => 'index'
        ]);

        $router->add('/'.$module.'/:controller', [
            'module'     => $module,
            'controller' => 1,
            'action'     => 'index'
        ]);

        $router->add('/'.$module.'/:controller/:action/:params', [
            'module'     => $module,
            'controller' => 1,
            'action'     => 2,
            'params'     => 3
        ]);
    }
    return $router;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url',function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});

//Set up the flash service
$di->set('flash', function() {
    return new \Phalcon\Flash\Direct();
});

$di->set('test', function(){
    return new \Library\Core\Test(); 
});

//Set up logger
$di->set("logger", function() use ($config){
    $file_name = $config->logger->system . 'system_'.date("Ymd").'.log';
    return new \Library\Core\Logger($file_name);// \Phalcon\Logger\Adapter\File($file_name);
});

//Set database
$di->set("db", function() use ($config){
return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname
    ));
});