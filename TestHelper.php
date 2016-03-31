<?php

use Phalcon\DI,
    Phalcon\DI\FactoryDefault;
use Phalcon\Config\Adapter\Ini;

ini_set('display_errors', 1);
error_reporting(E_ALL);
//require __DIR__ . '/../../vendor/autoload.php';
define('ROOT_PATH', __DIR__);
define('PATH_LIBRARY', __DIR__ . '/../app/library/');
define('PATH_SERVICES', __DIR__ . '/../app/services/');
define('PATH_RESOURCES', __DIR__ . '/../app/resources/');

define('PATH_INCUBATOR', __DIR__ . '/../vendor/incubator/');
define('PATH_CONFIG', __DIR__ . '/../app/config/org/config.ini');
define('PATH_MODELS', __DIR__ . '/../app/models/');

set_include_path(
        ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// required for phalcon/incubator
include __DIR__ . "/vendor/autoload.php";

include __DIR__ . "/library/core/models/Base.php";

include __DIR__ . "/library/core/Controller.php";

//spl_autoload_register(function () {
//    include_once 'apps/auth/controllers/LoginController.php';
//    include_once 'apps/auth/controllers/ControllerBase.php';
//    include_once 'apps/manageuser/controllers/ControllerBase.php';
////    require_once 'apps/manageuser/controllers/CoreMemberController.php';
//   
//    include_once 'apps/auth/models/Auth.php';
//    include_once 'apps/core/models/db/CoreMember.php';
//    include_once 'apps/auth/models/CoreMember.php';
//    include_once 'apps/auth/models/Permission.php';
//    include_once 'apps/auth/models/db/CorePermissionRelMember.php';
//    include_once 'apps/auth/models/db/CorePermissionGroup.php';
//    include_once 'apps/auth/models/db/CorePermission.php';
//});
spl_autoload_register(function () {
    include_once 'apps/auth/controllers/LoginController.php';
    include_once 'apps/auth/controllers/ControllerBase.php';
    include_once 'apps/auth/controllers/LogoutController.php';
    include_once 'apps/auth/models/Auth.php';
    include_once 'apps/core/models/db/CoreMember.php';
    include_once 'apps/auth/models/CoreMember.php';
    include_once 'apps/auth/models/Permission.php';
    include_once 'apps/auth/models/db/CorePermissionRelMember.php';
    include_once 'apps/auth/models/db/CorePermissionGroup.php';
    include_once 'apps/auth/models/db/CorePermission.php';
    include_once 'apps/dashboard/controllers/ControllerBase.php';
    include_once 'apps/dashboard/controllers/IndexController.php';
    include_once 'apps/dashboard/controllers/UserController.php';
    include_once 'apps/dashboard/models/Absent.php';
    include_once 'apps/dashboard/models/Attendances.php';
    include_once 'apps/dashboard/models/CoreNotification.php';
    include_once 'apps/dashboard/models/CorePermissionGroup.php';
    include_once 'apps/dashboard/models/CorePermissionGroupId.php';
    include_once 'library/core/Controller.php';
    include_once 'apps/core/models/db/Attendances.php';
    include_once 'apps/manageuser/controllers/ControllerBase.php';
    include_once 'apps/manageuser/models/User.php';
    include_once 'apps/core/models/CoreMember.php';
    //include_once "/library/core/lang/jp.php";
    include_once 'apps/attendancelist/controllers/AbsentController.php';
    include_once 'apps/attendancelist/controllers/ControllerBase.php';
    include_once 'apps/attendancelist/controllers/SearchController.php';
    include_once 'apps/attendancelist/controllers/UserController.php';
    include_once 'apps/leavedays/controllers/IndexController.php';
    include_once 'apps/leavedays/controllers/ControllerBase.php';
    include_once 'apps/leavedays/controllers/SearchController.php';
    include_once 'apps/leavedays/controllers/UserController.php';
    include_once 'apps/leavedays/models/LeaveCategories.php';
    include_once 'apps/leavedays/models/Leaves.php';
    include_once 'apps/leavedays/models/LeavesSetting.php';
    include_once 'apps/core/models/Permission.php';

    include_once 'apps/salary/controllers/CalculateController.php';
    include_once 'apps/salary/controllers/ControllerBase.php';
    include_once 'apps/salary/controllers/IndexController.php';
    include_once 'apps/salary/controllers/SalaryMasterController.php';
    include_once 'apps/salary/controllers/SearchController.php';
    include_once 'apps/salary/models/Allowances.php';
    include_once 'apps/salary/models/Salary.php';
    include_once 'apps/salary/models/SalaryDetail.php';
    include_once 'apps/salary/models/SalaryMaster.php';
    include_once 'apps/salary/models/SalaryMasterAllowance.php';
    include_once 'apps/salary/models/SalaryMemberTaxDeduce.php';
    include_once 'apps/salary/models/SalaryTaxs.php';
    include_once 'apps/salary/models/SalaryTaxsDeduction.php';

    include_once 'apps/document/controllers/IndexController.php';
    
    include_once 'apps/document/controllers/ControllerBase.php';
    include_once 'apps/document/models/CompanyInfo.php';
    include_once 'apps/document/models/CorePermissionGroupId.php';
    include_once 'apps/document/models/Document.php';
    include_once 'apps/document/models/SalaryDetail.php';
    include_once 'apps/document/models/SimpleImage.php';
});
// use the application autoloader to autoload the classes
// autoload the dependencies found in composer
$loader = new \Phalcon\Loader();

$loader->registerDirs(array(
    ROOT_PATH,
    PATH_CONFIG,
    PATH_MODELS
));

$loader->register();

$loader->registerNamespaces(array(
    'Phalcon' => PATH_INCUBATOR . 'Library/Phalcon/'
));

$config = new Ini(__DIR__ . '/config/org/config.ini');
//$config = include PATH_CONFIG;


$di = new FactoryDefault();

//db set up
$di->set('login_db', function() use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname
    ));
}, true);

$di->setShared('db', function() {

    //$database = (isset($_SESSION['db_config'])) ? $_SESSION['db_config'] : $config->database->database;
    if ($database = $_SESSION['db_config']) {
        return new \Phalcon\DB\Adapter\Pdo\Mysql([ 'host' => $database['host'],
            'dbname' => $database['db_name'],
            'username' => $database['user_name'],
            'password' => $database['db_psw'],
            'charset' => 'utf8'
        ]);
    } else {
        header('Location:http://localhost/salts');
    }
});
// add any needed services to the DI here

DI::setDefault($di);