<?php

/**
 * Description of leave
 * Test the Leave List,Apply Leave,Leave Setting.
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class LeaveTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
       
        $this->setBrowserUrl('http://localhost/salts');
    }

    public function testTitle() {

        $this->url('index.php');
        $this->assertEquals('Login', $this->title());
    }

    /**
     * 
     * @param type $euser
     * @author 
     * 
     */
    public function testLeave() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();
        $this->assertEquals('Attendance System', $this->title());
        $this->url('leavedays/index/leavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Leave Lists', $element->text());
    }

    public function testLeaveList() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Leave Lists', $element->text());
    }

    public function testListsearch() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');

        $llsearch = $this->byId('search');

        $ltype = $this->byName('ltype');
        $month = $this->byName('month');
        $namelist = $this->byName('namelist');
        $ltype->value('Family Case');
        $month->value('Feburary');
        $namelist->value('admin');
        $llsearch->click();
        $this->url('leavedays/index/leavelist');
    }

    public function testListExport() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');
        $this->byLinkText('Export')->click();
        $this->url('leavedays/index/leavelist');
    }

    public function testFirst() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');
        $this->byLinkText('First')->click();
        $this->url('leavedays/index/leavelist');
    }

    public function testNext() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');
        $this->byLinkText('Next')->click();
        $this->url('leavedays/index/leavelist');
    }

    public function testLast() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavelist');
        $this->byLinkText('Last')->click();
        $this->url('leavedays/index/leavelist');
    }

    public function testApplyLeave() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/applyleave');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Apply Leave', $element->text());
    }

    public function testApplyForm() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/applyleave');
        $form = $this->byId('apply_form');
        $apply = $this->byId('apply_form_submit');

        $name = $this->byName('username');
        $sdate = $this->byName('sdate');
        $edate = $this->byName('edate');
        $catego = $this->byName('leavetype');
        $descript = $this->byName('description');

        $name->value('admin');
        $sdate->value('2016-02-15 00:00:00');
        $edate->value('2016-02-19 00:00:00');
        $catego->value('Family Case');
        $descript->value('party');
        $apply->click();
        $this->url('leavedays/index/applyleave');
    }

    public function testApplyCancel() {

        $this->url('index.phtml');
        $list = $this->byId('pointer_style3');
        $list->click();

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/applyleave');
        $form = $this->byId('apply_form');
        $apply = $this->byId('apply_cancel');

        $name = $this->byName('username');
        $sdate = $this->byName('sdate');
        $edate = $this->byName('edate');
        $catego = $this->byName('leavetype');
        $descript = $this->byName('description');

        $name->value('admin');
        $sdate->value('2016-02-15 00:00:00');
        $edate->value('2016-02-19 00:00:00');
        $catego->value('Family Case');
        $descript->value('party');
        $apply->click();
        $this->url('leavedays/index/applyleave');
    }

    public function testLeaveSett() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavesetting');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Leave Setting', $element->text());
    }

    public function testLeaveSetEdit() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavesetting');
        $edit = $this->byId('editsetting');
        $save = $this->byId('savesetting');
        $edit->click();
        $day = $this->byName('max_leavedays');
        $day->value('15');
        $save->click();
        $this->url('leavedays/index/leavesetting');
    }

    public function testSalarySettDelete() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavesetting');
        $this->byCssSelector('a.ltypepopup')->click();
        $this->url('leavedays/index/leavelist');
    }

    public function testSalarySettAdd() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavesetting');
        $add = $this->byId('addinguser');
        $add->click();

        $save = $this->byId('Add_ltype');
        $leavetype = $this->byId('addinguser');
        $leavetype->value('aa');
        $save->click();
        $this->url('leavedays/index/leavesetting');
    }

    public function testSalarySettCancel() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('leavedays/index/leavelist');

        $this->byCssSelector('a')->click();
        $this->url('leavedays/index/leavesetting');
        $add = $this->byId('addinguser');
        $add->click();

        $cancel = $this->byId('cancel_ltype');
        $leavetype = $this->byId('addinguser');
        $leavetype->value('aa');
        $cancel->click();
        $this->url('leavedays/index/leavesetting');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
