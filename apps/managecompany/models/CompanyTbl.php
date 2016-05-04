<?php

namespace salts\Managecompany\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class CompanyTbl extends Model {

    public $company_name;
    public $email;
    public $phone_no;
    public $db_name;
    public $user_name;
    public $db_psw;
    public $host;
    public $user_limit;
    public $starting_date;
    public $created_dt;
    public $id;
    public function initialize() {
        //parent::initialize();
        $this->db = $this->getDI()->getShared("db");
    }

    /**
     * 
     * @param type $data
     * @param type $check
     * @author Su Zin Kyaw <gnext.suzin@gmail.com>
     * Add New Company to company_tbl table
     */
    public function addNew($data) {
        $date = date("Y-m-d H:i:s");
        $sdate = date("Y-m-d", strtotime($data['com_sdate']));
//        $CompanyTbl = new CompanyTbl();
//        $CompanyTbl->company_id = $data['comid'];
//        $CompanyTbl->company_name = $data['com_name'];
//        $CompanyTbl->email = $data['com_email'];
//        $CompanyTbl->phone_no = $data['com_phno'];
//        $CompanyTbl->db_name = $data['com_db'];
//        $CompanyTbl->user_name = $data['com_dbun'];
//        $CompanyTbl->db_psw = $data['com_dbpsw'];
//        $CompanyTbl->host = $data['com_host'];
//        $CompanyTbl->user_limit = $data['com_limit'];
//        $CompanyTbl->starting_date = $sdate;
//        $CompanyTbl->created_dt = $date;
//        $CompanyTbl->save();
        
        $sql = "INSERT INTO `company_tbl`(`company_id`, `company_name`, `email`, `phone_no`, "
                . "`db_name`, `user_name`, `db_psw`, `host`, `user_limit`, `starting_date`, "
                . "`created_dt`) VALUES "
                . "('" . $data['comid'] . "','" . $data['com_name'] . "','" . $data['com_email'] . "','" . $data['com_phno'] . "'"
                . ",'" . $data['com_db'] . "','" . $data['com_dbun'] . "','" . $data['com_dbpsw'] . "','" . $data['com_host'] . "',"
                . "'" . $data['com_limit'] . "','" . $sdate . "','" . $date . "')";
        $this->db->query($sql);
        for ($i = 0; $i < count($data['check']); $i++) {
            $EnableModule = new \salts\Core\Models\EnableModule();
            $EnableModule->company_id = $data['comid'];
            $EnableModule->module_id = $data['check'][$i];
            $EnableModule->save();
        }
        $this->createdb($data['com_host'],$data['com_db'],$data['com_dbun'],$data['com_dbpsw']);
        $message = "success";
        return $message;
    }

    
    public function createdb($host,$dbname,$username,$password){
            $dbhost = $host;
            $dbuser = $username;
            $dbpass = $password;
            $mysql_database = $dbname;
            $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to MySQL server: ' . mysql_error());
            $sql = 'CREATE Database '.$mysql_database.'';
            mysql_query( $sql, $conn );
            mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());
                // Temporary variable, used to store current query
                $templine = '';
               $filename = '../script/build/test.sql';
                $lines = file($filename);
                
                // Loop through each line
                foreach ($lines as $line)
                {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == ''){
                    continue;
                }
                // Add this line to the current segment
                $templine .= $line;
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';')
                {
                    // Perform the query
                    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                    // Reset temp variable to empty
                    $templine = '';
                }
                }
              
                echo "<script type='text/javascript'>alert('Company is added successfully');</script>";
                echo "<script type='text/javascript'>location.reload();</script>";
    }
    
    
    public function getAllcom() {
        $result = $this->db->query("select * from company_tbl where deleted_flag=0");
        $final_result = $result->fetchall();
        $i = 0;
        return $final_result;
    }

    public function findDatabyId($id) {
        $result = $this->db->query("select * from company_tbl where company_tbl.company_id='" . $id . "' ");
        $final_result = $result->fetchArray();
        return $final_result;
    }

    public function findCombyId($id) {
        $result = $this->db->query("select * from company_tbl where company_tbl.company_id='" . $id . "' ");
        $final_result = $result->fetchall();
        return $final_result;
    }

    public function findModulebyId($id) {
        $result = $this->db->query("select module_id from enable_module where enable_module.company_id='" . $id . "' ");
        $final_result = $result->fetchAll();
        return $final_result;
    }

    public function updateCom($com, $check) {
        $date = date("Y-m-d H:i:s");
        $sdate = date("Y-m-d", strtotime($com['sdate']));

        $sql = "UPDATE company_tbl set company_name= '" . $com['name'] . "' , email= '" . $com['email'] . "',"
                . "phone_no= '" . $com['phno'] . "',db_name= '" . $com['db'] . "' ,user_name= '" . $com['dbun'] . "',"
                . " db_psw= '" . $com['dbpsw'] . "',host= '" . $com['host'] . "',"
                . "user_limit= '" . $com['limit'] . "',starting_date= '" . $sdate . "',"
                . "updated_dt= '" . $date . "' where company_tbl.company_id= '" . $com['id'] . "'  ";
        $this->db->query($sql);
        $this->db->query("delete  from enable_module where enable_module.company_id='" . $com['id'] . "' ");
        for ($i = 0; $i < count($check); $i++) {
            $sql = "INSERT INTO `enable_module`(`company_id`, `module_id`) VALUES ('" . $com['id'] . "','" . $check[$i] . "')";
            $this->db->query($sql);
        }
    }

    public function deleteCompanyById($id) {
        $sql = "UPDATE `company_tbl` SET `deleted_flag`=1 WHERE `company_id` = '" . $id . "' ";
        $this->db->query($sql);
    }

    public function validation($data) {
      
        $res = array();
        $validate = new Validation();
        $validate->add('comid', new PresenceOf(
                array(
            'message' => ' * ID is required'
                )
        ));
        $validate->add('com_name', new PresenceOf(
                array(
            'message' => ' * Company Name is required'
                )
        ));
        $validate->add('com_sdate', new PresenceOf(
                array(
            'message' => ' * Starting date is required'
                )
        ));
        $validate->add('com_email', new PresenceOf(
                array(
            'message' => ' * email is required'
                )
        ));
        $validate->add('com_phno', new PresenceOf(
                array(
            'message' => ' * Phone number is required'
                )
        ));
        $validate->add('com_db', new PresenceOf(
                array(
            'message' => ' * Database is required'
                )
        ));
        $validate->add('com_dbun', new PresenceOf(
                array(
            'message' => ' * db username is required'
                )
        ));
       
        $validate->add('com_host', new PresenceOf(
                array(
            'message' => ' * DB host is required'
                )
        ));
        $validate->add('com_limit', new PresenceOf(
                array(
            'message' => ' * User Limit is required'
                )
        ));

        $messages = $validate->validate($data);
        if (count($messages)) {
            foreach ($messages as $message) {
                $res[] = $message;
            }
        }
        return $res;
    }

}
