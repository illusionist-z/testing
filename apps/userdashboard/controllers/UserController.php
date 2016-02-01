<?php

namespace salts\UserDashboard\Controllers;

use Phalcon\Config;
use Phalcon\Mvc\Url as UrlProvider;
use salts\Setting\Models\CorePermissionGroup;
use salts\Setting\Models\CorePermissionGroupId;
use salts\Setting\Models\CorePermissionRelMember;
use salts\Core\Models\Db\CoreMember;
use salts\Core\Models\Db;
use Phalcon\Http\Response;
use salts\UserDashboard\Controllers\ControllerBase;

/**
 * @author Yan Lin Pai  <> <wizardrider@gmail.com>
 * @desc     CorePermissionGroup
 */
class UserController {

    public function initialize() {
        
    }

    /**
     * @author David JP <david.gnext@gmail.com>
     * @desc    $core_group = {}
     * @Cover  Yan Lin Pai <wizardrider@gmail.com>
     * @desc    $core_groupid = {}
     * @desc    $core_user = {}
     */
    public function indexAction() {
        if ($this->permission == 1) {
            $coreid = new CorePermissionGroupId();
            $corememberid = new CorePermissionRelMember();
            $coreuser = new CoreMember();
            $coreuser2 = new CorePermissionGroup();
            $core_groupid = $coreid::find();
            $coremember = $corememberid::find();
            $core_groupuser2 = $coreuser2::find();
            $core_groupuser = $coreuser->getgroupid();
            $this->view->coreid = $core_groupid;
            $this->view->coremember = $coremember;
            $this->view->coreuser = $core_groupuser;
            $this->view->coreuser2 = $core_groupuser2;
        } else {
            $this->response->redirect('setting/user/usersetting');
        }
    }

    public function userdashboardAction() {
        //$this->response->redirect('setting/user/usersetting');
    }

}
