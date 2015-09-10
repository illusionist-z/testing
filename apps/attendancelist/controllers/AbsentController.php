<?php

namespace workManagiment\Attendancelist\Controllers;
use workManagiment\Attendancelist\Models\Attendances as Attendance;
use workManagiment\Core\Models\Db;
/**
 * @desc     Get absent member 
 * @category member_id
 * @since    30/7/15
 */
class AbsentController extends ControllerBase
{
    
    public function initialize() {
        parent::initialize();        
    }

    
    public function indexAction(){
       $Attendance = new Attendance();
       $Attendance->absent();      
       $this->view->disable(); 
    }
}    