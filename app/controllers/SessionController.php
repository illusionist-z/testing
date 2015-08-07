<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\View;
class SessionController extends ControllerBase
{
    public function initialize()
    {
       // $this->view->setTemplateAfter('main');
        //Phalcon\Tag::setTitle('Gnext attendance system');
        parent::initialize();

    }


    private function _registerSession($user)
    {
        //print_r($user);exit;
        $this->session->set('auth', array(
            'id' => $user['member_id'],
            'name' => $user['member_login_name'],
            'user_role' => $user['rank_code']
        ));
       //echo $this->session->auth['name'];exit;
        
    }


    public function loginAction()
    {
    	$users=new Users();
        

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user_result=$users->login($email,$password);
        
            if ($user_result != false) {

                $this->_registerSession($user_result);
                $this->flash->success('Welcome ' . $user_result['loginname']);
                
                if($this->session->auth['user_role']=='1'){
                return $this->response->redirect('admins/index');
                }
                else{
                    return $this->response->redirect('users/index');
                }
            }
            return $this->response->redirect('index?code=doekoedjorcfoehof');
            //$this->flash->error('Wrong email/password');
        
    }


    public function logoutAction()
    {
       //echo "logout";exit;
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->response->redirect('index');
    }


}
