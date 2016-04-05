<?php

namespace salts\Core\Models\Db;

class Attendances extends \Library\Core\Models\Base {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    public static function getInstance() {
        return new self();
    }

    public function LocalToUTC($data, $offset) {
        
        if ($offset < 0) {
            $value = $offset;
            $localtime = date("Y-m-d H:i:s", strtotime($value . " minutes", strtotime($data)));
            
        } else {
            $value = $offset;
            $localtime = date("Y-m-d H:i:s", strtotime($value . " minutes", strtotime($data)));
        }
        return $localtime;
    }

    public function UTCToLocal($data, $offset) {
        if ($offset < 0) {
            $sign = '-';
            $value = $offset * (-1);
        } else {
            $sign = '+';

            $value = $offset * (-1);
        }
        if ($sign == '-') {
            $time = new \DateTime($data);
            $time->add(new \DateInterval('PT' . $value . 'M'));
            $localtime = $time->format('H:i:s ');
        } else {
            $localtime = date(" H:i:s", strtotime($value . " minutes", strtotime($data)));
        }
        return $localtime;
    }
     /**
     * get count attendance day 
     * @return type
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function getCountattday($salary_start_date) {
        try {
            $dt = explode('-', $salary_start_date);
            $query = "select *,count(att_date) as attdate from attendances join core_member on attendances.member_id=core_member.member_id"
                    . " where YEAR(att_date)='" . $dt[0] . "' and MONTH(att_date)='" . $dt[1] . "' and (status = 0 or status=3) group by core_member.member_id";
            $data = $this->db->query($query);
            $result = $data->fetchall();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $result;
    }
}
