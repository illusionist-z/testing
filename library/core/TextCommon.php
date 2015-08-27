<?php namespace Lib\Core;
/**
 * @author Created by dungtn
 * @version 1.0
 * @package Fdoc
 * @subpackage FdocSystem
 *
 */

class TextCommon {

	/**
	 * instance object FDocTextCommon
	 *
	 * @var FDocTextCommon
	 */
	private static $_instance = null;

	/**
	 * Constructor method
	 *
	 */
	private function __construct(){

	}

	/**
	 * get Instance class
	 *
	 * @return FDocTextCommon
	 */
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			$cls = __CLASS__;
			self::$_instance = new $cls();
		}
		return self::$_instance;
	}

	/**
	 * trim space character mulbyte
	 *
	 * @param string $str
	 * @param string $chars
	 * @return string
	 */
	public static function trimMultiByte($str, $chars = '\s　') {
		$str = preg_replace("/^[$chars]+/u", '', $str);
		$str = preg_replace("/[$chars]+$/u", '', $str);
		return $str;
        }
	
	
	/**
	 * Truncate string to max length
	 *
	 * @param String $str
	 * @param Integer $maxLen
	 * @param String $replaceStr
	 * @param String $charset
	 * @return String
	 */
	public function mbTextTruncate ($str, $maxLen, $replaceStr = '。。。', $charset = 'UTF-8') {
		$intStrLen = mb_strlen($str, $charset);
		if($intStrLen <= $maxLen) return $str;

		$str = mb_substr($str, 0, $maxLen - mb_strlen($replaceStr, $charset), $charset);
		$str .= $replaceStr;		
		return $str;
	}
	
	/**
	 * filters value for CSV content
	 *
	 * @param string $val
	 * @return string
	 */
	public function filterCSV($val) {
		if (!$val)
			return;
		
		$ret = $val;

		if (preg_match("/,|\"|\r\n|\n/", $ret)) {
			$ret = preg_replace('/"/', '""', $ret);
		}
		$ret = '"' . $ret . '"';

		return $ret;
	}
    

    
    /**
     * @desc remove all the comment from sql string
     * 
     * @author Tuyendn<tuyendn@vnext.vn>
     */
    function removeComments(&$output) {
        $lines = explode("\n", $output);
        $output = "";

        // try to keep mem. use down
        $linecount = count($lines);

        $in_comment = false;
        for ($i = 0; $i < $linecount; $i++) {
            if (preg_match("/^\/\*/", preg_quote($lines[$i]))) {
                $in_comment = true;
            }

            if (!$in_comment) {
                $output .= $lines[$i] . "\n";
            }

            if (preg_match("/\*\/$/", preg_quote($lines[$i]))) {
                $in_comment = false;
            }
        }

        unset($lines);
        return $output;
    }


    
    /*
     * @desc split_sql_file will split an uploaded sql file into single sql statements.
     * Note: expects trim() to have already been run on $sql.
     *
     * @author Tuyendn<tuyendn@vnext.vn>
     */
    function splitSqlFile($sql, $delimiter) {
        // Split up our string into "possible" SQL statements.
        $tokens = explode($delimiter, $sql);

        // try to save mem.
        $sql = "";
        $output = array();

        // we don't actually care about the matches preg gives us.
        $matches = array();

        // this is faster than calling count($oktens) every time thru the loop.
        $token_count = count($tokens);
        for ($i = 0; $i < $token_count; $i++) {
            // Don't wanna add an empty string as the last thing in the array.
            if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0))) {
                // This is the total number of single quotes in the token.
                $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
                // Counts single quotes that are preceded by an odd number of backslashes,
                // which means they're escaped quotes.
                $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

                $unescaped_quotes = $total_quotes - $escaped_quotes;

                // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
                if (($unescaped_quotes % 2) == 0) {
                    // It's a complete sql statement.
                    $output[] = $tokens[$i];
                    // save memory.
                    $tokens[$i] = "";
                } else {
                    // incomplete sql statement. keep adding tokens until we have a complete one.
                    // $temp will hold what we have so far.
                    $temp = $tokens[$i] . $delimiter;
                    // save memory..
                    $tokens[$i] = "";

                    // Do we have a complete statement yet?
                    $complete_stmt = false;

                    for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++) {
                        // This is the total number of single quotes in the token.
                        $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                        // Counts single quotes that are preceded by an odd number of backslashes,
                        // which means they're escaped quotes.
                        $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

                        $unescaped_quotes = $total_quotes - $escaped_quotes;

                        if (($unescaped_quotes % 2) == 1) {
                            // odd number of unescaped quotes. In combination with the previous incomplete
                            // statement(s), we now have a complete statement. (2 odds always make an even)
                            $output[] = $temp . $tokens[$j];

                            // save memory.
                            $tokens[$j] = "";
                            $temp = "";

                            // exit the loop.
                            $complete_stmt = true;
                            // make sure the outer loop continues at the right point.
                            $i = $j;
                        } else {
                            // even number of unescaped quotes. We still don't have a complete statement.
                            // (1 odd and 1 even always make an odd)
                            $temp .= $tokens[$j] . $delimiter;
                            // save memory.
                            $tokens[$j] = "";
                        }
                    } // for..
                } // else
            }
        }

        return $output;
    }

    /**
     * @desc return array holiday date
     * 
     * @author Tran Nghia <nghiat@vnext.vn>
     * @since 2013/01/03
    */
    public function getAryHoliday() {
        $xmlPath = APPLICATION_PATH.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR. 'xml'.DIRECTORY_SEPARATOR.'holiday.xml';
        $strXml = simplexml_load_file($xmlPath);
        
        $aryHoliday = array();
        $aryJson = json_decode(json_encode($strXml));
        
        if(is_array($aryJson->day)) {
            foreach ($aryJson->day as $key => $value) {
                $aryHoliday[] = $value;
            }
        }
        
        return $aryHoliday;

    }
    
    /**
     * @desc return true/false
     * 
     * @author Tran Nghia <nghiat@vnext.vn>
     * @since 2013/01/03
    **/
    public function isHoliday($date) {
        
        //check weekend
        $day = date('D',strtotime($date));
        if($day == 'Sat' || $day == 'Sun')
            return true;
       
        //check holiday
        $date = date('Ymd',strtotime($date));
        $aryHoliday = $this->getAryHoliday();
        if(in_array($date, $aryHoliday))
            return true;
        else 
            return false;
    }
    /**
     * @desc remove string 2byte, 1byte space left, right
     * @author TuanDV <tuandv@vnext.vn>
     * @since 2013/12/30
     */
    public function trimValues(&$values){
        if(!is_array($values)) is_array ($values);
        if(empty($values)) return false;
        foreach($values as $key => $value){
            $values[$key] = trim($this->mbTrim($value));
        }
        return true;
    }

}
