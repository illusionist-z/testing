<?php
namespace salts\Salary\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;


class Salary extends \Library\Core\Models\Base {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public function chkValidate($data) {

        $ress = array();
        $validate = new Validation();
        $validate->add('uname', new PresenceOf(
                array(
            'message' => ' * Username is required'
                )
        ));
        $validate->add('bsalary', new Regex(
            array(
        'message' => '* Basic Salary is required',
        'pattern' => '/\+44 [0-9]+/'
            )
        ));
        $validate->add('travelfee', new Regex(
            array(
        'message' => '* Only number',
        'pattern' => '/\+44 [0-9]+/'
            )
        ));

        $group1 = new Check('checkall', array(
            'name' => 'checkall[]',
            'value' => '1'
        ));
        $group1->addValidator(new PresenceOf(array(
            'message' => 'Group 1 is required'
        )));
        $this->add($group1);
        
        $messages = $validate->validate($data);
        if (count($messages)) {
            foreach ($messages as $message) {
                $ress[] = $message;
            }
        }
        return $ress;
    }

    /**
     * @desc Output selected header
     * @param type []
     * @return []
     * @since 25/1/2016
     */
    public function getHeader($param) {
        $header = array();
        $n = 0;
        $num = 0;
        //get want field name
        $getField = ["member_id" => 0, "basic_salary" => 1, "travel_fee_perday" => 2,
            "travel_fee_permonth" => 3, "over_time" => 4, "ssc_emp" => 5, "ssc_comp" => 6, "salary_start_date" => 7];
        foreach ($param as $k => $j) {
            foreach ($j as $v) {
                if ($k === 0) {
                    if (array_key_exists($v["Field"], $getField)) {
                        if ($n === 0) {
                            $header[] = strtoupper($v["Field"]) . "(X)";
                        } else if ($n === 1) {
                            $header[] = "MEMBER_NAME(X)";
                            $header[] = "FULL_NAME(X)";
                            $header[] = strtoupper($v["Field"]) . "(INT)";
                        } else if ($n === 7) {
                            $header[] = strtoupper($v["Field"]) . "(Y-M-D)";
                        } else {
                            $header[] = strtoupper($v["Field"]) . "(INT)";
                        }
                        $n++;
                    }
                } else if ($k === 1) {
                    if ($num === 1) {
                        $header[] = strtoupper($v['deduce_id']) . "(No of children[0/1/...])";
                    } else {
                        $header[] = strtoupper($v['deduce_id']) . "(1/0)";
                    }
                    $num++;
                } else {
                    $header[] = strtoupper($v['allowance_name']) . "(1/0) ";
                }
            }
        }
        return $header;
    }

}
