<?php

use Phalcon\Config\Adapter\Ini as Ini;

/**
 * @uses individual module config
 * @param module name,$config data
 * @since 21/7/15
 * @author David
 */
Class Module_Config {
    
    protected static $config = array();

    public static function getModuleConfig($_module) {

        $moduleDirPath = __DIR__ . '/../../apps/';
        //$phpFileConfig = $moduleDirPath . $_module . '/config/config.php'; //get config dir php
        $iniFileConfig = $moduleDirPath . $_module . '/config/config.ini';
        
        if (file_exists($iniFileConfig)) {
            $configIni = new Ini($iniFileConfig);
            return self::$config = $configIni->toArray();
        }
        
    }

}
