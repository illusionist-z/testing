<?php

use Phalcon\Config\Adapter\Ini as Ini;

/**
 * @uses individual module config
 * @param module name,$config data
 * @since 21/7/15
 * @author David
 */
Class Module_Config {

    protected static $_cachedConfig = array();
    protected static $config = array();

    public static function getModuleConfig($_module, $_aryCondition = array()) {

        $moduleDirPath = __DIR__ . '/../apps/';
        $phpFileConfig = $moduleDirPath . $_module . '/config/config.php'; //get config dir php
        $iniFileConfig = $moduleDirPath . $_module . '/config/config.ini';

        if (file_exists($iniFileConfig)) {
            $configIni = new Ini($iniFileConfig, 'config');
            return self::$_cachedConfig[$_module] = $configIni->toArray();
        }

        /**
         * if config exist, return var 
         */
        if (file_exists($phpFileConfig)) {
            require($phpFileConfig);
            self::$config = $config;
            return self::$config;
        }
    }

}
