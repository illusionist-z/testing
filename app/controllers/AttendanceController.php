<?php
class AttendanceController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Gnext attendance system');
        parent::initialize();
        if(!isset($this->session->auth['user_role'])){
            header ("Location: ../index");
            }
    }
    
    //show today attendance list
     public function todaylistAction()
    {
         $users=new Users();
         $todaylist=$users->gettodaylist();
         $username=$users->getusername();
         $this->view->setVar("Getname", $username);
         $this->view->setVar("Result", $todaylist);
    }
    
    public  function searchlistAction(){
        $name=$this->request->get('namelist');
       
        $attendances=new Attendances();
        $result=$attendances->search_result($name);
        //print_r($result);exit;
        //return $this->response->redirect('index?name='.$list);
        $users=new Users();
        $username=$users->getusername();
        $this->view->setVar("Getname", $username);
        $this->view->setVar("Result", $result);
    }
}
