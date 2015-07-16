<?php namespace workManagiment\Leavedays\Models;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Leaves extends \Library\Core\BaseModel{
    
    public function initialize() {
        parent::initialize();
    }
    
    /**
     * 
     * @param type $leave_type
     * @param type $mth
     * @param type $username
     * @return type
     */
    public function getleavelist($leave_type, $mth, $username) {
        //select leave list
        $this->db = $this->getDI()->getShared("db");
        if (!isset($leave_type) and ! isset($mth) and ! isset($username)) {
            $sql = "SELECT * FROM leaves JOIN core_member ON leaves.member_id=core_member.member_id";
            $result = $this->db->query($sql);
            $row = $result->fetchall();
          
        } else {
            //search leave list
           
        }
       
        return $row;
    }
    
      public function getuserleavelist($leave_type, $mth,$id) {
        //select leave list
        
        $this->db = $this->getDI()->getShared("db");
        if (!isset($leave_type) and  !isset($mth) ) {
            $mth=date('m');
            $row = $this->modelsManager->createBuilder()
                    ->columns('date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Leavedays\Models\Leaves', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
                    ->where('MONTH( workManagiment\Leavedays\Models\Leaves.start_date) ="'.$mth.'" AND  workManagiment\Leavedays\Models\Leaves.member_id ="' .$id.'"')
                    ->getQuery()
                    ->execute();
        } else {
            $row = $this->modelsManager->createBuilder()
                    ->columns('date,start_date,member_login_name,end_date,leave_category,leave_status,leave_days,leave_description')
                    ->from('workManagiment\Core\Models\Db\CoreMember')
                    ->leftJoin('workManagiment\Leavedays\Models\Leaves', 'workManagiment\Core\Models\Db\CoreMember.member_id = workManagiment\Leavedays\Models\Leaves.member_id ')
                    ->where('MONTH( workManagiment\Leavedays\Models\Leaves.start_date) ="'.$mth.'" AND  workManagiment\Leavedays\Models\Leaves.leave_category ="' .$leave_type.'" AND  workManagiment\Leavedays\Models\Leaves.member_id ="' .$id.'"')
                    ->getQuery()
                    ->execute();
        }
         $currentPage = (int) $_GET["page"];
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 1,
            "page" => $currentPage
                )
        );
        $list = $paginator->getPaginate();
        //print_r($list);exit;
        return $list;
    }
    
   
}