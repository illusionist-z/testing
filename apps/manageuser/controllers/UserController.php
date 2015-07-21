<?php

namespace workManagiment\Manageuser\Controllers;
use workManagiment\Manageuser\Models\User as User;
/**
 * @author David
 * @type   User Editing
 * @data   Abstract User Model as $user
 */
class UserController extends ControllerBase {
    public $user;
    public function initialize() {
        parent::initialize();    
        $this->user = new User();
        $this->setCommonJsAndCss();                 
        $this->assets->addCss('common/css/dialog.css');
        $this->assets->addCss('common/css/jquery-ui.css');
        $this->assets->addCss('common/css/style.css');        
    }

    public function userlistAction() {               
        $list = $this->user->userlist();
        $this->view->setVar('username', $list);
        $this->view->setVar('type', 'userlist');
    }
    /**
     * @get data for user id
     * @return user data to dialog box
     * @author David
     * @since 20/7/15
     */
    public function usereditAction() {                       
        $name = $this->request->get('data');        
        $edit = $this->user->useredit($name);
        $this->view->setVar('edituser', $edit);
        $this->view->setVar('type', 'useredit');
    }  
    
    public function adduserAction(){
        
        $this->view->setVar('type','userlist');
        if ($this->request->isPost()) {
            $username= $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $dept = $this->request->getPost('dept');
            $position = $this->request->getPost('position');
            $email=$this->request->getPost('email');
            $phno= $this->request->getPost('phno');
            $address= $this->request->getPost('address');
            $filename=$_FILES["fileToUpload"]["name"];
           $target_dir = "../../common/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $image=$_FILES["fileToUpload"]["name"];
$img="uploads/1.jpg";
echo'<img src="'.$img.'">';
 echo '<img src="../../common/img/notid.png">';
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }
}exit;
          
            $newuser=new \workManagiment\Core\Models\Db\CoreMember;
            $newuser->addnewuser($username,$password, $dept, $position, $email,$phno,$address,$filename );            
            echo "<script type='text/javascript'>window.location.href='applyleave';</script>";
            $this->view->disable();
        } 
    }
}
