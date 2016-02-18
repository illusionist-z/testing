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

}
