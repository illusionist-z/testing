<?php

namespace salts\Salary\Models;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;

class SalaryMemberTaxDeduce extends Model {

    public function initialize() {
        $this->db = $this->getDI()->getShared("db");
    }

    public function getdeduceBymember_id($member_id) {
        try {
            $data = $this->db->query("SELECT deduce_id from salary_member_tax_deduce where member_id='" . $member_id . "'");
            $result = $data->fetchall();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $result;
    }

    /**
     * Edit tax deduce by memberid
     * @param type $deduce
     * @param type $member_id
     * @return type
     * @author Zin Mon <zinmonthet@myanmar.gnext.asia>
     */
    public function edit_taxByMemberid($deduce, $no_of_children, $member_id) {
        try {
            $count = $this->getdeduceBymember_id($member_id);
            $creartor_id = "admin";
            if (!empty($count)) {
                $delete = "DELETE FROM salary_member_tax_deduce WHERE member_id='" . $member_id . "'";
                $query = $this->db->query($delete);
                for ($i = 0; $i < count($deduce); $i++) {
                    try {
                        $sql = "INSERT INTO salary_member_tax_deduce (deduce_id,member_id,creator_id,created_dt) VALUES('" . $deduce[$i] . "','" . $member_id . "','" . $creartor_id . "',NOW())";
                        $result = $this->db->query($sql);
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                    }
                }
            } else {
                for ($i = 0; $i < count($deduce); $i++) {
                    $sql = "INSERT INTO salary_member_tax_deduce (deduce_id,member_id,creator_id,created_dt) VALUES('" . $deduce[$i] . "','" . $member_id . "','" . $creartor_id . "',NOW())";
                    $result = $this->db->query($sql);
                }
            }
            $sql = "UPDATE salary_member_tax_deduce SET"
                    . " no_of_children='" . $no_of_children . "' WHERE member_id='" . $member_id . "' and deduce_id='children'";
            $this->db->query($sql);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function getnoofchildrenBymember_id($member_id) {
        try {
            $sql = "SELECT no_of_children from salary_member_tax_deduce where member_id='" . $member_id . "' and deduce_id='children'";
            $data = $this->db->query($sql);
            $result = $data->fetchArray();
        } catch (Exception $ex) {
            echo $ex;
        }
        return $result['no_of_children'];
    }

}
