<?php

namespace salts\Setting\Controllers;

use salts\Core\Models\Db;
use salts\Core\Models\Db\CoreMember;
use Phalcon\Tag as Tag;

class UserController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->setCommonJsAndCss();
        $this->assets->addJs('apps/setting/js/user-changeprofile.js');
        $this->module_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->module_name);
       
        $this->view->module_name = $this->module_name;
        $this->view->permission = $this->permission;
    }

    public function indexAction() {
        $Admin = new Db\CoreMember;
        $id = $this->session->user['member_id'];

        foreach ($this->session->auth as $key_name => $key_value) {

            if ($key_name == 'show_admin_notification') {

                $Noti = $Admin->getAdminNoti($id, 0);
            }
            if ($key_name == 'show_user_notification') {

                $Noti = $Admin->getUserNoti($id, 1);
            }
        }

        $this->view->setVar("noti", $Noti);

        $user = $Admin->userDetail($id);
        $profile = $Admin->getProfile($id);
        $this->view->userDetail = $user;
        $this->view->profile = $profile;
    }

    public function usersettingAction() {
        $User = new Db\CoreMember;
        $id = $this->session->user['member_id'];
        $Noti = $User->getUserNoti($id);
        $this->view->setVar("noti", $Noti);
        $user = $User->UserDetail($id);
        $this->view->userdetail = $user;
    }

    /**
     * change profile 
     * user setting
     * @author Su Zin Kyaw
     */
    public function changeprofileAction() {
        if ($this->request->isPost()) {
            $updatedata = array();
            $updatedata = $this->request->getPost('member');
            $timezone = $this->request->getPost('timezone');
            if ($timezone != "0") {
                $arr = (explode(" ", $timezone));
                $sessiontz = $arr['1'];
                //convert +/- Hours to Seconds
                sscanf($sessiontz, "%d:%d:%d", $hours, $minutes, $seconds);
                $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                $s = ($time_seconds * -1);

                $this->session->set('tzoffset', array(
                    'offset' => $s,
                    'timezone' => $arr['2']
                ));
            }
            $id = $this->session->user['member_id'];

            
            
                $localhost = ($this->request->getServer('HTTP_HOST'));
     //   if ($this->permission == 1) {
            if (isset($_FILES['fileToUpload'])) {
                $file_type = $_FILES['fileToUpload']['type'];
                $file_size = $_FILES['fileToUpload']['size'];
                //  $file_type = $_FILES['uploaded_file']['type'];
                //   if (($file_size > 12000000)){      
                if (($file_size > 10000000)) {
                   $message = 'File too large. File must be less than 10 megabytes.';
                   $error =  '<script type="text/javascript">alert("' . $message . '");</script>';
                   $page = "http://" . $localhost . "/salts/document/index/letterhead";
                   $sec = "0";
                 header("Refresh: $sec; url=$page");
 
                } elseif (
                        ($file_type != "image/jpeg") &&
                        ($file_type != "image/jpg") &&
                        ($file_type != "image/gif") &&
                        ($file_type != "image/png")
                ) {
                    $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                    $error =  '<script type="text/javascript">alert("' . $message . '");</script>';
                    $page = "http://" . $localhost . "/salts/document/index/letterhead";
                    $sec = "0";
                    header("Refresh: $sec; url=$page");
 
                } else {
                     
                     
//File size small script
        function getExtension($str) {
            $i = strrpos($str, ".");
            if (!$i) {
                return "";
            }
            $l = strlen($str) - $i;
            $ext = substr($str, $i + 1, $l);
            return $ext;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $image = $_FILES["fileToUpload"]["name"];
            $uploadedfile = $_FILES['fileToUpload']['tmp_name'];

            if ($image) {

                $filename = stripslashes($_FILES['fileToUpload']['name']);
                $extension = getExtension($filename);
                $extension = strtolower($extension);

                if ($extension == "jpg" || $extension == "jpeg") {
                    $uploadedfile = $_FILES['fileToUpload']['tmp_name'];
                    $src = imagecreatefromjpeg($uploadedfile);
                } else if ($extension == "png") {
                    $uploadedfile = $_FILES['fileToUpload']['tmp_name'];
                    $src = imagecreatefrompng($uploadedfile);
                } else {
                    $src = imagecreatefromgif($uploadedfile);
                }

                 //echo $scr; 
                list($width, $height) = getimagesize($uploadedfile);

                $newwidth =150;
                $newheight = ($height / $width) * $newwidth;
                $tmp = imagecreatetruecolor($newwidth, $newheight);

                $newwidth1 = 250;
                $newheight1 = ($height / $width) * $newwidth1;
                $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                $filename = $_FILES['fileToUpload']['name'];
                imagejpeg($tmp, $filename, 100); 
                 
                echo $filename;
                exit();
                //$filename =   "<img src=". $file." /> "; 
                       
                //$file_name = file_get_contents($file);
                //File upload script
//                $input_name = '<input style="margin-top: 10px;" type="file"   name="img_name"   id="fileToUpload" disabled="true" style="padding-bottom: 39px"> ';
//                $filename =   "<img src=". $file." /> "; 
                          
        $MY_FILE = 'http://localhost/salts/public/'.$_FILES[$filename]['tmp_name'];
       
        echo $MY_FILE;
   
         
        $file = fopen($MY_FILE, 'r');
        $file_contents = fread($file, filesize($MY_FILE));
        fclose($file);
        $file_contents = addslashes($file_contents);
        if($file_contents==NULL){
            $file_contents=$this->request->getPost('temp_profile');
        }
            $User = new \salts\Setting\Models\CoreMember();
            $User->updatedata($updatedata, $id,$file_contents);
            $user = $User->userData($id);
            $this->session->set('user', $user);
                                   
                //File upload script
                unlink($filename);
                imagedestroy($src);
                imagedestroy($tmp); 
                 
            }
        } 
        
   //File size small script
  
            
        }        
        $this->response->redirect('setting/user');
    }  
        }
            }

}
