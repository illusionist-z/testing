<?php

/**
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class ManageUserTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {      
        
        $this->setBrowserUrl('http://localhost/salts');
        $this->prepareSession()->currentWindow()->maximize();
    }

    public function testMenu() {       
        $this->url('dashboard/index/admin');
        $manageuser = $this->byId('pointer_style1');
        $manageuser->click();
        $this->url('manageuser/index/index');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('User Lists', $element->text());
    }

    public function testSearch() {

        $this->url('manageuser/index/index');
        $searchclick = $this->byId('userlistsearch');
        $searchbox = $this->byName('username');
        $searchbox->value('TT');
        $searchclick->click();
        sleep(2);
    }

    public function testAddUserAdd() {
        $this->url('manageuser/index/index');
        $addinguser = $this->byId('addinguser');
        $addinguser->click();
        sleep(3);
        $this->byId('saveuser');
        $adduser = $this->byId('add_user');
        $this->byName('uname')->value('Jaff');
        $this->byName('full_name')->value('Jaff Way');
        $this->byName('password')->value('Jaffway');
        $this->byName('confirm')->value('Jaffway');
        $this->byName('work_sdate')->value('2016-02-09');
        $this->byId('dept')->value('Testing');
        $this->byName('position')->value('Tester');
        $this->byName('email')->value('Jaffway@gmail.com');
        $this->byName('phno')->value('2598741');
        $this->byName('address')->value('London');
        $this->byName('user_role')->value('TEST');
        sleep(3);
        $adduser->click();
        $this->url('manageuser/index/index');
        sleep(4);
    }

    public function testAddUserCancel() {
        $this->url('manageuser/index/index');
        $this->byId('addinguser')->click();
        sleep(2);
        $form = $this->byId('saveuser');
        $adduser = $this->byId('addinguser_close');
        $adduser->click();
        $this->url('manageuser/index/index');
    }

    public function testEditUserEdit() {
        $this->url('manageuser/index/index');
        $this->byCssSelector('.inedit')->click();
        sleep(2);
        $editform = $this->byId('edit_user');
        $edit = $this->byId('edit_edit');

        $editusername = $this->byName('name');
        $editusername->clear();
        $editworkdate = $this->byName('work_sdate');
        $editworkdate->clear();
        $department = $this->byName('dept');
        $department->clear();
        $position = $this->byName('position');
        $position->clear();
        $email = $this->byName('email');
        $email->clear();
        $phno = $this->byName('pno');
        $phno->clear();
        $address = $this->byName('address');
        $address->clear();

        $editusername->value('Jaffway');
        $editworkdate->value('2016-01-01');
        $department->value('Testing');
        $position->value('Tester');
        $email->value('Jaffway@gmail.com');
        $phno->value('123456789');
        $address->value('London');
        $edit->click();
    }

    public function testEditUserCancel() {
        $this->url('manageuser/index/index');
        $this->byCssSelector('.inedit')->click();
        sleep(2);
        $editform = $this->byId('edit_user');
        $delete = $this->byId('edit_close');
        $delete->click();
        $this->url('manageuser/index/index');
    }

    public function testFirst() {

        $this->url('manageuser/index/index');


        $this->byLinkText('First')->click();
        $this->url('manageuser/index/index');
    }

    public function testNext() {

        $this->url('manageuser/index/index');


        $this->byLinkText('Next')->click();
        $this->url('manageuser/index/index');
    }

    public function testLast() {

        $this->url('manageuser/index/index');


        $this->byLinkText('Last')->click();
        $this->url('manageuser/index/index');
    }

    public function testEdit() {
        $this->url('manageuser/index/index');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byId('edit_user_name')->clear();
        $this->byId('edit_user_name')->value('Kyaw Kyaw');
         $this->byId('edit_mm_name')->value('ေက်ာ္ေက်ာ္');
        $this->byId('edit_edit')->click();
        sleep(2);
        $e = $this->byXPath("//td[contains(text(),'Kyaw Kyaw')]");
        $this->assertEquals('Kyaw Kyaw', $e->text());
    }

    public function testDelete() {
        $this->url('manageuser/index/index');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byId('edit_delete')->click();
        $this->assertEquals('Are you sure to delete ?', $this->byCssSelector('div#confirm p')->text());
        $link = $this->byCssSelector('div.ui-dialog-buttonpane div.ui-dialog-buttonset button.ui-button span.ui-button-text');
        $this->assertEquals('Yes', $link->text());
        $link->click();
        
    }

    public function testNotDelete() {
        $this->url('manageuser/index/index');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byId('edit_delete')->click();
        $this->assertEquals('Are you sure to delete ?', $this->byCssSelector('div#confirm p')->text());
        $submitLink = $this->byXPath("//span[contains(text(),'No')]");
        $submitLink->click();
    }

    public function testCancel() {
        $this->url('manageuser/index/index');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byId('edit_close')->click();
        $this->url('manageuser/index/index#');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
