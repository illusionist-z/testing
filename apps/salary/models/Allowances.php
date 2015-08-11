<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;

class Allowances extends Model {

    public function initialize() {
        parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }
    /**
     * 
     * @param type $all_value
     * @param type $all_name
     * @param type $count
     * Adding Allowances to allowance table
     */
    public function addallowance($all_value,$all_name,$count){
    $created_date=date("Y-m-d H:i:s");
    $this->db=$this->getDI()->getShared("db");  
     for ($x = 1; $x <$count; $x++) {
     //echo $all_name['"'.$x.'"'];echo $all_value['"'.$x.'"'];
    $this->db->query("INSERT INTO allowances (allowance_id,allowance_name,allowance_amount,created_dt) VALUES (uuid(),'" . $all_name['"'.$x.'"'] . "','" . $all_value['"'.$x.'"'] . "','" . $created_date . "')");
    }
      echo '<script type="text/javascript">alert("Allowances are Added Successfully! ")</script>';
     echo "<script type='text/javascript'>window.location.href='../../salary/index/allowance';</script>";
    }
    /**
     * get alw list with paging
     * @author Su Zin Kyaw
     * @return type
     */
    public function showalwlist(){
        
        $row = $this->modelsManager->createBuilder()
                    ->columns('allowance_id,allowance_name,allowance_amount')
                    ->from('workManagiment\Salary\Models\Allowances')
                    ->orderBy('workManagiment\Salary\Models\Allowances.created_dt DESC')
                    ->getQuery()
                    ->execute();
        $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 3,
            "page" => $currentPage
                )
        );                
        $list = $paginator->getPaginate();
      
        return $list;
        
    }

}
