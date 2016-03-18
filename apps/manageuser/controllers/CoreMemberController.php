<?php

namespace salts\Manageuser\Controllers;

use salts\Manageuser\Models\User as User;
use salts\Manageuser\Models\AddUser;
use salts\Core\Models\Db\CoreMember;

/**
 * @author David
 * @type   User Editing
 * @data   Abstract User Model as $user
 */
class CorememberController extends ControllerBase {

    public $user;

    public function initialize() {
        parent::initialize();
        $this->user = new User();
        $this->setCommonJsAndCss();
        $this->setManageUserControllerJsAndCss();
        $this->act_name = $this->router->getModuleName();
        $this->permission = $this->setPermission($this->act_name);
          $this->view->permission = $this->permission;
    }

    /**
     * ADD NEW USER 
     * @author Su Zin Kyaw
     * @version 26/8/2015 David
     * 
     */
    public function saveuserAction() {
         if ($this->permission == 1) {
        $json = array();
        //form validation init
        if ($this->request->isPost()) {
            $user = new AddUser();
            $id = $this->request->getPost('uname');
            $exist_id = CoreMember::findByMemberLoginName($id);
            if (count($exist_id) > 0) {
                $json['uname'] = "Name already taken ! Choose Other Please!";
                $json['result'] = "existId";
                echo json_encode($json);
                $this->view->disable();
            } else {
                $validate = $user->validat($this->request->getPost());
                if (count($validate)) {
                    foreach ($validate as $message) {
                        $json[$message->getField()] = $message->getMessage();
                    }
                    $json['result'] = "error";
                    echo json_encode($json);
                    $this->view->disable();
                } else {

                    
                    
                     $localhost = ($this->request->getServer('HTTP_HOST'));
     //   if ($this->permission == 1) {
            if (isset($_FILES['fileToUpload'])) {
                $file_type = $_FILES['fileToUpload']['type'];
                $file_size = $_FILES['fileToUpload']['size'];
                //  $file_type = $_FILES['uploaded_file']['type'];
                //   if (($file_size > 12000000)){      
                if (($file_size > 1000000)) {
                    $message = 'File too large. File must be less than 10 megabytes.';
                    $error =  '<script type="text/javascript">alert("' . $message . '");</script>';
//                      $page = "http://" . $localhost . "/salts/document/index/letterhead";
//                      $sec = "0";
//                      header("Refresh: $sec; url=$page");
                    $json['result'] = $error;
                    echo json_encode($json);
                } elseif (
                        ($file_type != "image/jpeg") &&
                        ($file_type != "image/jpg") &&
                        ($file_type != "image/gif") &&
                        ($file_type != "image/png")
                ) {
                    $message = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
                      $error =  '<script type="text/javascript">alert("' . $message . '");</script>';
//                      $page = "http://" . $localhost . "/salts/document/index/letterhead";
//                      $sec = "0";
//                      header("Refresh: $sec; url=$page");
                    $json['result'] = $error;
                    echo json_encode($json);
                } else {
              
                       $member = $this->request->getPost();
                       $member_id = $this->session->user['member_id'];
                       $MY_FILE = $_FILES['fileToUpload']['tmp_name'];
                        $file = fopen($MY_FILE, 'r');
                        $file_contents = fread($file, filesize($MY_FILE));
                        fclose($file);
                        $file_contents = addslashes($file_contents);
       
                    $NewUser = new CoreMember;
                    
                    $NewUser->addNewUser($member_id, $member, $file_contents);

                    $this->view->disable();
                    // Make a full HTTP redirection
                    $json['result'] = "success";
                    echo json_encode($json);
                    
                }
            }
            
            
                }
            }
        }
         }
         else {
             echo 'Page Not Found';
         }
    }

}
