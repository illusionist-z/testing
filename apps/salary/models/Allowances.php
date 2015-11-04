<?php

namespace workManagiment\Salary\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
    use Phalcon\Filter;

class Allowances extends Model {

    public function initialize() {
       
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
      
     
    }
    
    /**
     * get allowance list with paging
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
        
        return $row;
    }
    
    
    /**
     * 
     * @param type $data
     * update edited data to allowances table
     * @author Su Zin Kyaw
     */
    public function edit_allowance($data){
        try{
             $filter = new Filter();
             $name = $filter->sanitize($data['name'], "string");
             $allowance_amount = $filter->sanitize($data['allowance_amount'], "string");
         $sql = "Update allowances SET allowance_name ='". $name ."',allowance_amount ='".$allowance_amount."' Where allowances.allowance_id='".$data['id']."'";
         $this->db->query($sql);
     } catch (Exception $ex) {
         echo $ex;
     }
    }
    
    /**
     * 
     * @param type $id
     * delete allowance data
     * @author Su Zin Kyaw
     */
    public function delete_allowance($id){
        try{
        $sql = "Delete From allowances  Where allowances.allowance_id='".$id."'";
        $this->db->query($sql);
        } catch (Exception $ex) {
        echo $ex;
        }
    }
    
    
    public function getall_allowances() {
        try {
            $sql = "select * from allowances";
            //echo $sql.'<br>';
            $result = $this->db->query($sql);
            $row = $result->fetchall();
            
        } catch (Exception $ex) {
            echo $ex;
        }

        return $row;
    }
    
    /**
     * 
     * @param type $allowance
     * @param type $member_id
     * @return type
     * @author zin mon
     */
    public function saveallowance($allowance,$member_id) {
        try {
            
            for($i=0;$i<count($allowance);$i++)
            {
            $sql = "INSERT INTO salary_master_allowance (allowance_id,member_id) VALUES('" . $allowance[$i] . "','" . $member_id . "')";
            $result = $this->db->query($sql);   
            }
        } catch (Exception $e) {
            echo $e;
        }

        //return $result;
    }
    
    public function editall($allid){
         try{
            $sql = "select * from allowances where allowances.allowance_id ='".$allid."'";
            $result = $this->db->query($sql);
            $row = $result->fetchall();     
        }catch(Exception $e){
            echo $e;
        }
        return $row;
    }
    
   
    

}

