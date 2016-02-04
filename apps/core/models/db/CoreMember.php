<?php

namespace salts\Core\Models\Db;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query; 
use salts\Core\Models\Db\CorePermissionRelMember;
use salts\Core\Models\Db\CorePermissionGroupId;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;

/*
 * TODO: delete [Kohei Iwasa]
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

    public function moduleIdSetPermission($v, $m) {
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

    public function getusername() {
        $query = "SELECT * FROM salts\Core\Models\Db\CoreMember WHERE deleted_flag=0 order by created_dt desc";
        $row = $this->modelsManager->executeQuery($query);
        return $row;
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
        $group_id = $data->fetchall();
        return $group_id;
    }

    public function getgroupid() {
        $query = "Select member_id,member_login_name,group_id,core_member.deleted_flag from core_member "
                . "left join core_permission_rel_member on core_member.member_id=core_permission_rel_member.rel_member_id "
                . "left join core_permission_group_id on core_permission_group_id.name_of_group = core_permission_rel_member.rel_permission_group_code";
        $data = $this->db->query($query);
        $group_id = $data->fetchall();
        return $group_id;
    }

    public function username($name) {
        $name = '%' . $name . '%';
        $query = "SELECT * FROM salts\Core\Models\Db\CoreMember WHERE full_name = '$name' AND deleted_flag=0 order by created_dt desc";
        $row = $this->modelsManager->executeQuery($query);
        foreach ($row as $rs) {
            echo '<li>' . $rs->full_name . '</li>';
        }
        $this->find($rs);
        return $row;
    }

    /*
     * user list search with name in user list
     */
    public function getoneusername($username) {

        $filter = new Filter();
        $username = $filter->sanitize($username, "string");
        $getname = $this->modelsManager->createBuilder()
                ->columns(array('core.*'))
                ->from(array('core' => 'salts\Core\Models\Db\CoreMember'))
                ->where('core.member_login_name = :username:', array('username' => $username))
                ->andWhere('core.deleted_flag = 0')
                ->getQuery()
                ->execute();
        return $getname;
    }

    public function getusernamebyid($id) {
        $sql = "select * from core_member WHERE member_id ='" . $id . "'";
        $result = $this->db->query($sql);
        $row = $result->fetchall();
        $name = $row[0]['member_login_name'];
        return $name;
    }

    public function searchuser($search) {
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
    public function getlastname() {
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

    public function getlang($member) {
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
    public function addnewuser($member_id, $member) {
        $arr = (explode(",", $member['user_role']));
        $pass = sha1($member['password']);
        $today = date("Y-m-d H:i:s");
        $filter = new Filter();
        $username = $filter->sanitize($member['uname'], "string");
        $full_name = $filter->sanitize($member['full_name'], "string");

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

        $this->db->query("INSERT INTO core_member (user_rule,member_id,full_name,member_login_name,member_password,member_dept_name,position,member_mail,lang,member_mobile_tel,member_address,member_profile,creator_id,created_dt,updated_dt,working_start_dt)"
                . " VALUES('" . $arr['1'] . "',uuid(),'" . $full_name . "','" . $username . "','" . $pass . "','" . $dept . "','" . $position . "','" . $email . "','" . $lang . "','" . $phno . "','" . $address . "','" . $newfilename . "','" . $member_id . "','" . $today . "','0000-00-00 00:00:00','" . $member['work_sdate'] . "')");
        $user_name = $this->db->query("SELECT * FROM core_member WHERE  member_login_name='" . $member['uname'] . "'");
        $us = $user_name->fetchall();

        foreach ($us as $value) {
            $sql = "INSERT INTO core_permission_rel_member (rel_member_id,permission_group_id_user,rel_permission_group_code,creator_id,created_dt)"
                    . " VALUES('" . $value['member_id'] . "','" . $arr['1'] . "','" . $arr['0'] . "','" . $member_id . "',now())";
            $this->db->query($sql);
        }
    }

    public function UserDetail($id) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $result = $user->fetchall();
        return $result;
    }

    public function Userdata($id) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("SELECT * FROM core_member WHERE member_id='" . $id . "'");
        $result = $user->fetchArray();
        return $result;
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
        $noti = $AdminNoti->fetchall();


        $i = 0;
        foreach ($noti as $noti) {

            $sql = "SELECT  * FROM " . $noti['module_name'] . " JOIN core_member ON core_member.member_id=" . $noti['module_name'] . ".member_id WHERE " . $noti['module_name'] . ".noti_id='" . $noti['noti_id'] . "' and core_member.deleted_flag=0 ";

            $result = $this->db->query($sql);
            $final_result[] = $result->fetchall();

            $final_result[$i]['0']['creator_name'] = $noti['creator_name'];
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
    public function GetUserNoti($id, $type) {
        $final_result = array();
        $this->db = $this->getDI()->getShared("db");
        $sql = "SELECT * FROM core_notification_rel_member JOIN core_member ON core_member.member_id=core_notification_rel_member.member_id WHERE core_notification_rel_member.status='" . $type . "' AND core_notification_rel_member.member_id= '" . $id . "' order by created_dt desc";
        $UserNoti = $this->db->query($sql);

        $noti = $UserNoti->fetchall();
        $i = 0;
        foreach ($noti as $noti) {

            $result = $this->db->query("SELECT  * FROM " . $noti['module_name'] . " JOIN core_member ON core_member.member_id=" . $noti['module_name'] . ".member_id WHERE " . $noti['module_name'] . ".noti_id='" . $noti['noti_id'] . "' ");
            $final_result[] = $result->fetchall();
            $final_result[$i]['0']['creator_name'] = $noti['creator_name'];
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

        if ($_FILES["fileToUpload"]["name"] == NULL) {
            $filename = $data['file'];
        } else {
            $pic = $data['file'];
            unlink("uploads/$pic");
            $filename = rand(1, 99999) . '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));
            $target_dir = "uploads/";
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
    public function autousername() {
        $this->db = $this->getDI()->getShared("db");
        $user_name = $this->db->query("Select * from core_member where deleted_flag=0");
        $getname = $user_name->fetchall();
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
    public function checkleave() {
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
    public function leavemost() {
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

    /**
     * Saw Zin Min Tun
     * forget password

     */
    public function findemail($member_mail) {

        $email = $member_mail;
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT * FROM core_member where member_mail ='" . $email . "'  and deleted_flag=0";
        $user = $this->db->query($query);
        $users = $user->fetchAll();

        return $users;
    }

    /**
     * Saw Zin Min Tun
     * forget password

     */
    public function insertemailandtoken($member_mail, $token) {
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("INSERT INTO forgot_password(check_mail,token,curdate) values(' " . $member_mail . " ' ,' " . $token . " ',now() )");

        return $user;
    }

    /*
     * User Fix 
     * tokenpush
     * timeflag
     * @author Yan Lin Pai <wizardrider@gmail.com>
     *     
     */

    public function tokenpush($member_id, $tokenpush, $user_ip) {
        $this->db = $this->getDI()->getShared("db");
        $member_log = $this->db->query("INSERT INTO member_log(token,member_id,ip_address) values(' " . $member_id . " ' ,' " . $tokenpush . " ',' " . $user_ip . " ' )");

        return $member_log;
    }

    public function timeflag($member_id, $formtdate) {
        $this->db = $this->getDI()->getShared("db");
        $member_flag = $this->db->query("UPDATE core_member set timeflag = '" . $formtdate . "' WHERE member_login_name ='" . $member_id . "' ");

        return $member_flag;
    }

    /**
     * Saw Zin Min Tun
     * user enter code check database code
     */
    public function findcode($code, $email) {

        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT token FROM forgot_password where  check_mail = '" . $email . "'  order by curdate desc limit 1  ";
        $user = $this->db->query($query);
        $user = $user->fetchArray();

        if ($user['token'] == $code) {
            $msg = "success";
            return $msg;
        } else {
            $msg = "fail";
            return $msg;
        }
    }

    /**
     * Saw Zin Min Tun
     * forget password
     */
    public function updatepassword($member_mail, $newpassword) {
        // Check if the user exist
        $newpassword = sha1($newpassword);
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("UPDATE core_member set member_password = '" . $newpassword . "' WHERE member_mail ='" . $member_mail . "' ");
        return $user;
    }

    public function updatenewpassword($member_mail, $newpass) {
        $newpassword = sha1($newpass);
        $this->db = $this->getDI()->getShared("db");
        $user = $this->db->query("UPDATE core_member set member_password = '" . $newpassword . "' WHERE member_mail ='" . $member_mail . "' ");
        return $user;
    }

    public function checkyourmail($getmail) {
        $this->db = $this->getDI()->getShared("db");
        $query = "SELECT token FROM forgot_password where  check_mail = '" . $getmail . "'  order by curdate desc limit 1  ";
        $user = $this->db->query($query);
        $user = $user->fetchArray();
        return $user['token'];
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
