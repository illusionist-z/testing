<?php

namespace Library\Core;

/**
 * Logger level 3, log every thing :)
 *
 * Class Vlib_Logger_LevelThree
 */
class Export extends \Phalcon\Logger\Adapter\File {

    public function __construct($name, $options = null) {
        //echo $name;exit;
        parent::__construct($name, $options);
    }
    public function export() {
        echo "vv";exit;
    }

}
