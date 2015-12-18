<?php

/**
 * Register application modules
 */
$aryModules = \Library\Core\Module::get();
//print_r($aryModules);exit;
// Regist modules
foreach ($aryModules as $module) {
    $regModules[$module] = [
        'className' => 'salts\\' . $module . '\Module',
        'path' => __DIR__ . '/../apps/' . $module . '/Module.php'
    ];
}
$application->registerModules($regModules);

