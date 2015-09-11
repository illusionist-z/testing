<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;


class CoreMemberTaxDeduce extends Model {

    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    
    public function getdeduceBymember_id($member_id){
        try{
            $data=$this->db->query("SELECT deduce_id from core_member_tax_deduce where member_id='".$member_id."'");
            $result=$data->fetchall();
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
    public function edit_taxByMemberid($deduce,$member_id) {
         try{            
            $count=  $this->getdeduceBymember_id($member_id);
            $creartor_id="admin";
            if(!empty($count)){
                $delete="DELETE FROM core_member_tax_deduce WHERE member_id='".$member_id."'";
                $query=  $this->db->query($delete);
                for($i=0;$i<count($deduce);$i++){
                   
                    try {
                        
                $sql = "INSERT INTO core_member_tax_deduce (deduce_id,member_id,creator_id,created_dt) VALUES('".$deduce[$i]."','". $member_id . "','".$creartor_id. "',NOW())";
                
                $result = $this->db->query($sql);
                        
                       
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                    }
                
                }
            }
            else{
                for($i=0;$i<count($deduce);$i++){
                $sql = "INSERT INTO core_member_tax_deduce (deduce_id,member_id,creator_id,created_dt) VALUES('".$deduce[$i]."','". $member_id . "','".$creartor_id. "',NOW())";
                //echo $sql.'<br>';
                $result = $this->db->query($sql);
                
                }
            }
            //exit;
        } catch (Exception $ex) {
            echo $ex;
        }
        //return $result;
    }
   

}
