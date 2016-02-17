<?php

namespace salts\Core\Models\Db;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault;
use salts\Auth\Models\Db\AuthFailedLogins; 
use salts\Core\Models\Db\CorePermissionRelMember;
use salts\Core\Models\Db\CorePermissionGroupId;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Filter;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//  include_once '/var/www/html/salts/library/core/BaseModel.php';
class CoreMember extends \Library\Core\Models\Base {

    // Use trait for singleton
    use \Library\Core\Models\SingletonTrait;

    public function initialize() {
        parent::onConstruct();
    }

    
    
     public function findCompDb($param) {
       
        try {
            $sql = "SELECT * FROM company_tbl where company_id='".$param['company_id']."' and deleted_flag=0";
            //print_r($sql);
//            $rs = $this->getDI()->getShared("login_db")
//                    ->query($sql, array($param['company_id']));
            $rs=$this->login_db->query($sql);
            
            $row = $rs->fetchArray();
        } catch (\Exception $e) {
            $di = FactoryDefault::getDefault();
            $di->getShared('logger')->WriteException($e);
        }
       //print_r($row);exit;
        return $row;
    }
    
    public function findModule($company_module) {
        $sql = "SELECT * FROM enable_module where company_id='" . $company_module . "' ";
        $Result = $this->login_db->query($sql);
        $Result = $Result->fetchAll();
        return $Result;
    }

    /**
     * Checks the user credentials
     *
     * @param array $loginParams
     * @return boolan
     */
    public function Check($loginParams, & $user = null) {
       
        $filter = new Filter();
        $name = $filter->sanitize($loginParams['member_login_name'], "string");
        $password = $loginParams['password'];
        $database = $_SESSION['db_config'];
        if ($database['db_name'] == 'company_db') {
            $sql = "SELECT * FROM user_tbl where login_name='" . $name . "' and password='" . sha1($password) . "' and deleted_flag=0";
        } else {
            $sql = "SELECT * FROM core_member where member_login_name= '" . $name . "' and member_password='" . sha1($password) . "' and deleted_flag=0";
        }
        $user = $this->db->query($sql);
        $user = $user->fetchArray();
        return $user;
    }

    public function getPermit($loginParams) {
        $filter = new Filter();
        $name = $filter->sanitize($loginParams['member_login_name'], "string");
        $password = $loginParams['password'];
        $this->db = $this->getDI()->getShared("db");

        $user = $this->db->query("SELECT * FROM core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user = $user->fetchArray();
        
        $permission = $this->db->query("SELECT permission_group_id_user FROM core_permission_rel_member where rel_member_id='" . $user['member_id'] . "' ");
        $permission_name = $permission->fetchArray();
        return $permission_name['permission_group_id_user'];
    }

    /**
     * Implements login throttling
     * Reduces the efectiveness of brute force attacks
     *
     * @param int $userId
     */
    public function failedLogin($userId) {
        try {
            $failedLogin = new AuthFailedLogins();
            $failedLogin->user_uuid = $userId;
            $failedLogin->ip_address = $this->request->getClientAddress();
            $failedLogin->attempted = time();
            $failedLogin->save();

            $attempts = AuthFailedLogins::count(array(
                        'ip_address = ?0 AND attempted >= ?1',
                        'bind' => array(
                            $this->request->getClientAddress(),
                            time() - 3600 * 6
                        )
            ));

            switch ($attempts) {
                case 1:
                case 2:
                    // no delay
                    break;
                case 3:
                case 4:
                    sleep(2);
                    break;
                default:
                    sleep(4);
                    break;
            }
        } catch (\Exception $e) {
            $di = FactoryDefault::getDefault();
            $di->getShared('logger')->WriteException($e);
        }
    }

    /**
     * 
     * @param type $userObject
     */
    private function _setUserInfo($userObject) {
        $user = [
            'id' => $userObject->id,
            'name' => $userObject->name,
            'kana' => $userObject->kana,
            'dept_code' => $userObject->dept_code,
            'dept_name' => $userObject->dept_name,
            'lang' => $userObject->lang,
            'email01' => $userObject->email01,
            'rank_code' => $userObject->rank_code,
        ];
        $this->session->set('user', $user);
    }
    
    
    
    public function ModuleIdSetPermission($v, $m) {

        //// Module ID Filter Start
        $module_id_set = $m;
        foreach ($module_id_set as $module_name) {
            if ($module_name['module_id'] == $v) {
                $var_id = 1;
            }
        }
        //// Module ID Filter End
        if (isset($var_id)) {
            $module_id_return = 1;
        } else {
            $module_id_return = 0;
        }
        return $module_id_return;
    }

    public function getUserName($currentPage) {
        $row = CoreMember::find("deleted_flag = 0 order by created_dt desc");
        $paginator = new PaginatorModel(
                array(
            "data" => $row,
            "limit" => 10,
            "page" => $currentPage
                )
        );
// Get the paginated results
        $page = $paginator->getPaginate();
        return $page;
    }

    public function module_permission() {
        $this->db = $this->getDI()->getShared("db");
        $query = "Select permission_code,permission_name_en,permission_name_$lang from core_permission where permission_code ='$code'";
        $data = $this->db->query($query);
        $result = $data->fetchall();
        return $result;
    }

    /*
     * @Count Member Limit
     * @Inset Buyer Code
     * @Yan Lin Pai <Yan Lin Pai>
     */

    public function getNumberCount() {
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT COUNT(*) FROM core_member WHERE deleted_flag=0 order by created_dt desc";
        $data = $this->db->query($query);
        $groupid = $data->fetchall();
        return $groupid;
    }

    public function getGroupId($currentPage = null) {
        try {
            $row = $this->modelsManager->createBuilder()
                    ->columns(array('core.*', 'coregroup.group_id'))
                    ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                    ->Leftjoin('salts\Core\Models\CorePermissionRelMember', 'core.member_id = rel.rel_member_id', 'rel')
                    ->Leftjoin('salts\Core\Models\Db\CorePermissionGroupId', 'rel.rel_permission_group_code = coregroup.name_of_group', 'coregroup')
                    ->where('core.deleted_flag = 0')
                    ->getQuery()
                    ->execute();
            $paginator = new PaginatorModel(
                    array(
                "data" => $row,
                "limit" => 3,
                "page" => $currentPage
                    )
            );
// Get the paginated results
            $page = $paginator->getPaginate();
        } catch (Phalcon\Exception $e) {
            $di->getShared("logger")->error($e->getMessage());
        }
        return $page;
    }

    public function username($name) {
        $name = '%' . $name . '%';
        $query = "SELECT * FROM salts\Core\Models\Db\CoreMember WHERE full_name = '$name' AND deleted_flag=0 order by created_dt desc";
        $row = $this->modelsManager->executeQuery($query);
        foreach ($row as $rs) {
            echo '<li>' . $rs->full_name . '</li>';
        }
        return $row;
    }

    /*
     * user list search with name in user list
     */

    public function getOneUsername($username,$currentPage) {
        try{
        $filter = new Filter();
        $username = $filter->sanitize($username, "string");
        $row = $this->modelsManager->createBuilder()
                ->columns(array('core.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->where('core.member_login_name = :username:', array('username' => $username))
                ->andWhere('core.deleted_flag = 0')
                ->getQuery()
                ->execute();
           $paginator = new PaginatorModel(
                    array(
                "data" => $row,
                "limit" => 3,
                "page" => $currentPage
                    )
            );
// Get the paginated results
            $page = $paginator->getPaginate();
        } catch (Phalcon\Exception $e) {
            $di->getShared("logger")->error($e->getMessage());
        }
        return $page;
    }

    public function getUsernameById($id) {

        $sql = "select * from core_member WHERE member_id ='" . $id . "'";
        $result = $this->db->query($sql);
        $row = $result->fetchall();
        $name = $row[0]['member_login_name'];

        return $name;
    }

    public function searchUser($search) {
        $filter = new Filter();
        $search = $filter->sanitize($search, "string");
        $searchname = $this->db->query("select member_login_name from core_member where member_login_name like '%$search%' ");
        $return = $searchname->fetchall();
        return $return;
    }

    /**
     * @author david
     * @return username by last month
     */
    public function getLastName() {
        $username = "SELECT * FROM salts\Core\Models\Db\CoreMember where deleted_flag=0 order by  created_dt desc limit 4";
        $laname = $this->modelsManager->executeQuery($username);
        return $laname;
    }

    /**
     * 
     * @param type $loginParams
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * updating core member updated_dt after one year
     */
    public function updatecontract($loginParams) {
        $filter = new Filter();
        $name = $filter->sanitize($loginParams['member_login_name'], "string");
        $password = $filter->sanitize($loginParams['password'], "string");
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * from core_member where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        $user1 = $user->fetchall();
        $today = date("Y-m-d");
        if ($user1['0']['working_year_by_year'] == NULL) {
            $end_date = date('Y-m-d', strtotime("+1 year", strtotime($user1['0']['working_start_dt'])));
        } else {
            $end_date = date('Y-m-d', strtotime("+1 year", strtotime($user1['0']['working_year_by_year'])));
        }

        if (strtotime($end_date) <= strtotime($today)) {
            $this->db->query("UPDATE core_member set core_member.working_year_by_year='" . $end_date . "'  where member_login_name='" . $name . "' and member_password='" . sha1($password) . "'");
        }
    }

    public function getLang($member) {
        $filter = new Filter();
        $name = $filter->sanitize($member['member_login_name'], "string");
        $query = "Select lang from core_member where member_login_name ='" . $name . "'";
        $result = $this->db->query($query);
        $lang = $result->fetch();
        return $lang;
    }

    /**
     * 
     * @param type $member_id
     * @param type $member
     * @param type $filename
     * @return string
     */
    public function addNewUser($member_id, $member) {
        $arr = (explode(",", $member['user_role']));
        $pass = sha1($member['password']);
        $today = date("Y-m-d H:i:s");
        $filter = new Filter();
        $username = $filter->sanitize($member['uname'], "string");
        $full_name = $filter->sanitize($member['full_name'], "string");
        $ssn = $member['ssn_no'] === "" ? : $filter->sanitize($member['ssn_no'],"string");
        $pass = $filter->sanitize($pass, "string");
        $dept = $filter->sanitize($member['dept'], "string");
        $position = $filter->sanitize($member['position'], "string");
        $email = $filter->sanitize($member['email'], "email");
        $phno = $filter->sanitize($member['phno'], "int");
        $address = $filter->sanitize($member['address'], "string");

        //uploading file
        $target_dir = "uploads/";
        $profile = $_FILES["fileToUpload"]["name"];
        $Real_pic_name = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = rand(1, 99999) . '.' . end($Real_pic_name);
        $targetfile = $target_dir . $newfilename;
        $lang = "en";
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetfile);

        $phql = "INSERT INTO salts\Core\Models\Db\CoreMember (user_rule,ssn_no,member_id,full_name,member_login_name,member_password,member_dept_name,position,member_mail,lang,member_mobile_tel,member_address,member_profile,creator_id,created_dt,updated_dt,working_start_dt)"
                . " VALUES('" . $arr['1'] . "','".$ssn."',uuid(),'" . $full_name . "','" . $username . "','" . $pass . "','" . $dept . "','" . $position . "','" . $email . "','" . $lang . "','" . $phno . "','" . $address . "','" . $newfilename . "','" . $member_id . "','" . $today . "','0000-00-00 00:00:00','" . $member['work_sdate'] . "')";
        $this->modelsManager->executeQuery($phql);
        $user_name = CoreMember::find("member_login_name = '".$member['uname']."'");
        $us = $user_name->toArray();

        foreach ($us as $value) {
            $rel_member = new \salts\Core\Models\CorePermissionRelMember();
            $rel_member->rel_member_id = $value['member_id'];
            $rel_member->permission_group_id_user = $arr[1];
            $rel_member->rel_permission_group_code = $arr[0];
            $rel_member->creator_id = $member_id;
            $rel_member->created_dt = $today;
            $rel_member->save();
        }
    }

    public function userDetail($id) {

        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $user = $user->fetchall();
        return $user;
    }

    public function userData($id) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $user = $user->fetchArray();
        return $user;
    }

    /**
     * 
     * @return type
     * getting pending leavedays detail
     * for admin notification
     * @author Su Zin Kyaw
     */
    public function getAdminNoti($id, $type) {
        $final_result = array();
        $this->db = $this->getDI()->getShared("db");
        if ($type == 0) {

            $sql = "SELECT * FROM core_notification JOIN core_member ON core_member.member_id=core_notification.noti_creator_id WHERE core_notification.noti_status='" . $type . "' AND core_notification.noti_creator_id='" . $id . "' order by created_dt asc  ";
        } else if ($type == 2) {

            $sql = "SELECT * FROM core_notification JOIN core_member ON core_member.member_id=core_notification.noti_creator_id WHERE core_notification.noti_status='0' AND core_notification.noti_creator_id='" . $id . "' order by created_dt asc   ";
        } else {
            $sql = "SELECT * FROM core_notification JOIN core_member ON core_member.member_id=core_notification.noti_creator_id WHERE core_notification.noti_status='" . $type . "' AND core_notification.noti_creator_id='" . $id . "' order by created_dt asc limit 10";
        }

        $AdminNoti = $this->db->query($sql);
        $Noti = $AdminNoti->fetchall();


        $i = 0;
        foreach ($Noti as $Noti) {

            $sql = "SELECT  * FROM " . $Noti['module_name'] . " JOIN core_member ON core_member.member_id=" . $Noti['module_name'] . ".member_id WHERE " . $Noti['module_name'] . ".noti_id='" . $Noti['noti_id'] . "' and core_member.deleted_flag=0 ";

            $result = $this->db->query($sql);
            $final_result[] = $result->fetchall();

            $final_result[$i]['0']['creator_name'] = $Noti['creator_name'];
            $i++;
        }

        $data = array();
        foreach ($final_result as $result) {
            foreach ($result as $value) {
                if (isset($value['module_name'])) {
                    $data[] = $value;
                }
            }
        }
        if ($type == 2) {
            $data = array_slice($data, 0, 10);
        }


        return $data;
    }

    /**
     * 
     * @param type $id
     * @param type $type 
     * Type 1 for new 
     * type 2 for old
     * @return type
     * getting accepted and rejected leavedays detail
     * for user notification
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     */
    public function getUserNoti($id, $type) {

        $final_result = array();
        $this->db = $this->getDI()->getShared("db");
        $sql = "SELECT * FROM core_notification_rel_member JOIN core_member ON core_member.member_id=core_notification_rel_member.member_id WHERE core_notification_rel_member.status='" . $type . "' AND core_notification_rel_member.member_id= '" . $id . "' order by created_dt desc";
        $UserNoti = $this->db->query($sql);
        $Noti = $UserNoti->fetchall();

        $i = 0;
        foreach ($Noti as $Noti) {

            $result = $this->db->query("SELECT  * FROM " . $Noti['module_name'] . " JOIN core_member ON core_member.member_id=" . $Noti['module_name'] . ".member_id WHERE " . $Noti['module_name'] . ".noti_id='" . $Noti['noti_id'] . "' ");
            $final_result[] = $result->fetchall();
            $final_result[$i]['0']['creator_name'] = $Noti['creator_name'];
            $i++;
        }
        $data = array();
        foreach ($final_result as $result) {
            foreach ($result as $value) {
                if (isset($value['module_name'])) {
                    $data[] = $value;
                }
            }
        }
        return $data;
    }

    /**
     * 
     * @param type $data
     * updating core member'profile
     * while user change something in profile
     * @author Su Zin Kyaw
     */
    public function updatedata($data, $id) {
          $this->db = $this->getDI()->getShared("db");
         $company_id=($this->getDI()->getSession()->get(db_config)['company_id']);
         $target_dir = "uploads/$company_id./";
        
        if (!is_dir($target_dir)) {
         mkdir($target_dir);
       }
        if ($_FILES["fileToUpload"]["name"] == NULL) {
            $filename = $data['file'];
        } else {
            $pic = $data['file'];
            unlink("uploads/$pic");
            $filename =($this->getDI()->getSession()->get(db_config)['company_id'])."__".($this->getDI()->getSession()->get(user)['member_id']). '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
            $target_file = $target_dir . $filename;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }

        if ($data['password'] == $data['temp_password']) {

            $this->db->query("UPDATE core_member set core_member.member_login_name='" . $data['username'] . "' , "
                    . "core_member.member_dept_name='" . $data['dept'] . "' , core_member.position='" . $data['position'] . "'"
                    . ", core_member.member_mail='" . $data['email'] . "' , core_member.member_address='" . $data['add'] . "'"
                    . ", core_member.member_mobile_tel='" . $data['phno'] . "' ,core_member.member_profile='" . $filename . "' WHERE core_member.member_id='" . $id . "' ");
        } else {
            $changeprofile = "UPDATE core_member set core_member.member_login_name='" . $data['username'] . "' ,  "
                    . "core_member.member_dept_name='" . $data['dept'] . "' , core_member.position='" . $data['position'] . "' "
                    . " ,core_member.member_mail='" . $data['email'] . "' , core_member.member_mobile_tel='" . $data['phno'] . "' "
                    . " ,core_member.member_address='" . $data['add'] . "' , core_member.member_password='" . sha1($data['password']) . "' ,core_member.member_profile='" . $filename . "' WHERE core_member.member_id='" . $id . "'";
            $this->db->query($changeprofile);
        }
        return $filename;
    }

    /**
     * 
     * @param type $id
     * @param type $sdate
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * update noti seen when user click ok
     */
    public function updateleave($id, $sdate) {
        $this->db = $this->getDI()->getShared("db");
        $sql = "UPDATE leaves set leaves.noti_seen=1 WHERE leaves.start_date='" . $sdate . "' AND leaves.member_id='" . $id . "'";
        $a = $this->db->query($sql);
    }

    //for auto complete function
    public function autoUsername() {
        $user_name = CoreMember::find('deleted_flag = 0');
        $getname = $user_name->toArray();        
        return $getname;
    }

    public function GetAdminstratorId() {
        $this->db = $this->getDI()->getShared("db");
        $result = $this->db->query("SELECT rel_member_id FROM core_permission_rel_member JOIN core_member ON core_member.member_id=core_permission_rel_member.rel_member_id WHERE core_permission_rel_member.rel_permission_group_code='ADMIN' ");
        $result = $result->fetchall();

        return $result;
    }

    /**
     * @author david
     * @return array {leave name}
     * @return array {no leave name}
     * @version saw zin min tun
     */
    public function checkLeave() {
        $res = array();
        $this->db = $this->getDI()->getShared("db");

        //select where no leave name in current month
        $query1 = "select * from core_member where member_id not in
                   (select member_id from absent where date >(NOW()-INTERVAL 2 MONTH) and deleted_flag = 0) and deleted_flag=0 order by created_dt desc";
        $data1 = $this->db->query($query1);
        $res['noleave_name'] = $data1->fetchall();
        return $res;
    }

    /**
     * @author david
     * @return array {leave name}
     * @return array {no leave name}
     * @version saw zin min tun
     */
    public function leaveMost() {
        $res = array();
        $this->db = $this->getDI()->getShared("db");
        //select where user most leave taken
        $query = "select * from core_member "
                . "as c join absent as a on c.member_id=a.member_id "
                . "where a.deleted_flag=0  and c.deleted_flag = 0 group by a.member_id "
                . "order by count(*)";
        $data = $this->db->query($query);
        $res['leave_name'] = $data->fetchall();

        return $res;
    }

  

    /*
     * User Fix 
     * tokenpush
     * timeflag
     * @author Yan Lin Pai <wizardrider@gmail.com>
     *     
     */

    public function tokenPush($member_id, $tokenpush, $user_ip) {
        $this->db = $this->getDI()->getShared("db");
        $member_log = $this->db->query("INSERT INTO member_log(token,member_id,ip_address) values(' " . $member_id . " ' ,' " . $tokenpush . " ',' " . $user_ip . " ' )");

        return $member_log;
    }

    public function timeFlag($member_id, $formtdate) {
        $this->db = $this->getDI()->getShared("db");
        $member_flag = $this->db->query("UPDATE core_member set timeflag = '" . $formtdate . "' WHERE member_login_name ='" . $member_id . "' ");

        return $member_flag;
    }

    public function findUserAddSalary($id) {
        $cond1 = "Select * from core_member where member_id not in ( select member_id from salary_master)";
        $cond2 = "Select * from core_member where member_id in ( select member_id from salary_master)";
        (1 == $id) ? $query = $cond1 : $query = $cond2;
        $data = $this->db->query($query);
        $rows = $data->fetchall();
        return $rows;
    }

}
