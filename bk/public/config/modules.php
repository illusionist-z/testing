<?php
/**
 * Register application modules
 */
$aryModules = \Lib\Core\Module::get();
// Regist modules
foreach ($aryModules as $module) {
    $regModules[$module] = [
        'className' => 'workmanagements\\'.$module.'\Module',
        'path' => __DIR__ . '/../apps/'.$module.'/Module.php'
    ];
}
$application->registerModules($regModules);