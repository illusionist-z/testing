<?php namespace Library\Core;
/**
 * Logger level 3, log every thing :)
 *
 * Class Vlib_Logger_LevelThree
 */
class Logger extends \Phalcon\Logger\Adapter\File{

    public function __construct($name, $options = null) {
        //echo $name;exit;
        parent::__construct($name, $options);
    }
    
    public function _error($errorMsg, $title = '',$context = null) {
        // General case
        $tmp = debug_backtrace();
        $class = $tmp[1]['class'];
        $function = $tmp[1]['function'];
        $file = $tmp[1]['file'];
        $line = $tmp[1]['line'];
        $title = ($title =='') ? '' : '['.$title.']';
        $serverAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']: 'CLI';
        $message = '['.$class.'::'.$function.'()]'."[$serverAddress]{$title}[$file][LINE:$line]".$errorMsg;
        $this->error($message,$context);
    }
    
    public function WriteException($e){
        $serverAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']: 'CLI';
        $message = '[Error Code:'.$e->getCode().']'.'['.$serverAddress.']'.PHP_EOL;
        $message.= $e->getMessage();
        
        $tmp = $e->getTrace();
        foreach($tmp as $step => $v){
            $message .= PHP_EOL.'#STEP '.$step.PHP_EOL;
            $message .= print_r($v,TRUE);
        }
        $this->error($message,null);
    }

    /**
     * @param $errorMsg
     * @param string $title
     */
//    public function error($errorMsg, $title = 'error')
//    {
//        
//        // General case
//        $tmp = debug_backtrace();
//        $class = $tmp[2]['class'];
//        $function = $tmp[2]['function'];
//        $file = $tmp[1]['file'];
//        $line = $tmp[1]['line'];
//        $logData = "[$class::$function()] [Error message = $errorMsg ]";
//        $type = self::ERROR;
//        $serverAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']: 'CLI';
//        $message = "[$serverAddress] [$type] [$title] $logData [$file][$line]";
//        
//        
//        $di = \Phalcon\DI\FactoryDefault::getDefault();
//        $di->getShared('logger')->log($message,\Phalcon\Logger::ERROR);
//    }


    /**
     * @param $_arrTrace
     * @param $logTitle
     */
    private function writeDebugLog($_arrTrace, $logTitle)
    {
        $_function = $_arrTrace[1]['function'];
        $_class = $_arrTrace[1]['class'];
        $_file = $_arrTrace[0]['file'];
        $_line = $_arrTrace[0]['line'];
        $logData = "[" . $_class . "::" . $_function . "()]";
        $this->write(self::DEBUG, $logTitle, $logData, $_file, $_line);
    }

}
 