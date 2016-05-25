<?php

/**
 * Description of Salary
 * Test the Add Salary,Salary List,Monthly Salary,Salary Setting and Allowance.
 * @param type $euser
 * @author KhinNyeinChanThu
 * 
 */
class SalaryTest extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {

        $this->setBrowserUrl('http://localhost/salts');
        $this->prepareSession()->currentWindow()->maximize();
    }

    /**
     * Description of Salary
     * Test the Salary in Dashboard
     * @author KhinNyeinChanThu
     * 
     */
    public function testChecksalary() {
        $this->url('dashboard/index/admin');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');
        sleep(3);
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Salary Lists', $element->text());
    }

    /**
     * Description of Salary
     * Test Salary List Search button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalarySearch() {

        $this->url('salary/index/salarylist');
        $form = $this->byId('frm_search');
        $saluser = $this->byName('username');
        $salperfees = $this->byName('travel_fees');
        $saluser->value('Euser');
        $salperfees->value('Travel fees per day');
        $form->submit();
        $this->url('salary/index/salarylist');
    }

    /**
     * Description of Salary
     * Test the Salary List Export button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryListExport() {

        $this->url('salary/index/salarylist');
        $form = $this->byId('frm_search');
        $form->submit();
        $this->url('salary/index/salarylist');
    }

    /**
     * Description of Salary
     * Test the Add Salary
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryAdd() {

        $this->url('salary/index/salarylist');
        $this->byCssSelector('a')->click();
        $this->url('salary/index/addsalary');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Add Salary For Each Member', $element->text());
    }

    /**
     * Description of Salary
     * Test the Add Salary apply button
     * @param type $euser
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryApplyform() {

        $this->url('salary/index/addsalary');
        sleep(5);
        $form = $this->byId('add_salary');

        $salaryuname = $this->byName('uname');
        $bsalary = $this->byName('bsalary');
        $tfeesradio = $this->byId('radtravel1');

        $tfees = $this->byName('travelfees');
        $overtime = $this->byName('overtime');
        $sscfather = $this->byId('checkall3');
        $sscmother = $this->byId('checkall4');
        $allowance = $this->byName('check_allow[]');
        $sdate = $this->byName('s_sdate');

        $salaryuname->value('admin');
        $bsalary->value('250000');
        $tfeesradio->click();
        $tfees->value('2000');
        $overtime->value('600');
        $sscfather->click();
        $sscmother->click();
        $allowance->click();
        $sdate->value('01/01/2016');
        $form->submit();
        sleep(3);
        $this->url('salary/index/salarylist');
    }

    /**
     * Description of Salary
     * Test the Add Salary Cancel button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryCancelform() {

        $this->url('salary/index/addsalary');
        sleep(5);
        $form = $this->byId('add_salary');
        $cancel = $this->byId('add_salary_cancel');

        $salaryuname = $this->byName('uname');
        $bsalary = $this->byName('bsalary');
        $tfeesradio = $this->byId('radtravel1');

        $tfees = $this->byName('travelfees');
        $overtime = $this->byName('overtime');
        $sscfather = $this->byId('checkall3');
        $sscmother = $this->byId('checkall4');
        $allowance = $this->byName('check_allow[]');
        $sdate = $this->byName('s_sdate');

        $salaryuname->value('admin');
        $bsalary->value('250000');
        $tfeesradio->click();
        $tfees->value('2000');
        $overtime->value('600');
        $sscfather->click();
        $sscmother->click();
        $allowance->click();
        $sdate->value('01/01/2016');
        $cancel->click();
        $this->url('salary/index/addsalary');
    }

    /**
     * Description of Salary
     * Test the Monthly Salary Calculate salary button
     * @author KhinNyeinChanThu
     * 
     */
    public function testMonthlySalaryCalculateSave() {
        $this->url('salary/index/monthlysalary');
        sleep(3);
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Salary List', $element->text());
        $this->byCssSelector('h4.add-big')->click();
        $this->waitUntil(function () {
            return $this->byId("salary_start")->displayed();
        }, 5000);
        $cal = $this->byId("salary_start");
        $cal->value('2016-02-01');
        $this->clickOnElement("cal_salary_month");
        sleep(2);
        $this->url('salary/index/monthlysalary');
    }

    public function testMonthlySalaryCalculateCancel() {
        $this->url('salary/index/monthlysalary');
        sleep(4);
        $this->byCssSelector('h4.add-big')->click();
        $this->waitUntil(function () {
            return $this->byId("cancel_deduct")->displayed();
        }, 5000);
        $cancel = $this->byId('cancel_deduct');
        $cancel->click();
        $this->url('salary/index/monthlysalary');
    }

    /**
     * Description of Salary
     * Test the Monthly Salary Export button
     * @author KhinNyeinChanThu
     * 
     */
    public function testMonthlySalaryExport() {

        $this->url('salary/index/monthlysalary');
        $elements = $this->elements($this->using('css selector')->value('img#exicon'));
        $this->assertEquals(3, count($elements));
        $link = $this->byLinkText($elements[1]->text());
        $link->click();
        $this->url('salary/index/monthlysalary');
    }

    /**
     * Description of Salary
     * Test the Salary Setting
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalarySetting() {

        $this->url('/salary/index/salarysetting');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Salary Setting', $element->text());
    }

    /**
     * Description of Salary
     * Test the Salary Setting Tax button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalarySettingTax() {

        $this->url('salary/index/salarysetting');
        sleep(5);
        $this->byLinkText('Tax')->click();
        $this->url('salary/index/salarysetting');
    }

    /**
     * Description of Salary
     * Test the Salary Setting Deduction button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalarySettingDeduction() {

        $this->url('salary/index/salarysetting');
        sleep(5);
        $this->byLinkText('Deduction')->click();
        $this->url('salary/index/salarysetting');
    }

    /*
     * Description of Salary
     * Test the Salary Setting Tax Edit button
     * @author KhinNyeinChanThu
     * 
     */

    public function testSalarySettingTaxEdit() {

        $this->url('salary/index/salarysetting');
        sleep(5);
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byId("edit_tax_table")->displayed();
        }, 2000);
        $save = $this->byId('edit_tax_table');
        $taxform = $this->byName('taxs_from');
        $taxform->clear();
        $taxto = $this->byName('taxs_to');
        $taxto->clear();
        $taxrate = $this->byName('taxs_rate');
        $taxrate->clear();
        $sscemp = $this->byName('ssc_emp');
        $sscemp->clear();
        $ssccomp = $this->byName('ssc_comp');
        $ssccomp->clear();
        $taxform->value('369');
        $taxto->value('222222');
        $taxrate->value('3');
        $sscemp->value('2');
        $ssccomp->value('1');
        $save->click();
        $this->url('salary/index/salarysetting');
    }

    public function testSalarySettingTaxEditCancel() {

        $this->url('salary/index/salarysetting');
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byId("edit_close")->displayed();
        }, 2000);
        $cancel = $this->byId('edit_close');
        $cancel->click();
        $this->url('salary/index/salarysetting');
    }

    /*
     * Description of Salary
     * Test the Salary Setting Deduction Add New button 
     * @author KhinNyeinChanThu
     * 
     */

    public function testSalarySettingDedAdd() {
        $this->url('salary/index/salarysetting');
        $this->waitUntil(function () {
            return $this->byLinkText('Deduction')->displayed();
        }, 2000);
        $this->byLinkText('Deduction')->click();
        $this->byId('add_dec')->click();
        $this->waitUntil(function () {
            return $this->byId('Add_new_deduct')->displayed();
        }, 2000);
        $this->byCssSelector('input')->value('test');
        $this->byName('amount')->value('400');
        $this->byId("Add_deduct")->click();
        $this->url('salary/index/salarysetting');
    }

    public function testSalarySettingDedAddCancel() {
        $this->url('salary/index/salarysetting');
        $this->waitUntil(function () {
            return $this->byLinkText('Deduction')->displayed();
        }, 2000);
        $this->byLinkText('Deduction')->click();
        $this->byId('add_dec')->click();
        $this->waitUntil(function () {
            return $this->byId('Add_new_deduct')->displayed();
        }, 2000);
        $this->byId('cancel_deduct')->click();
        $this->url('salary/index/salarysetting');
    }

    /**
     * Description of Salary
     * Test the Allowance
     * @author KhinNyeinChanThu
     */
    public function testAllowance() {

        $this->url('salary/index/salarysetting');
        $this->byCssSelector('a')->click();
        $this->url('salary/index/allowance');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Allowance', $element->text());
    }

    /**
     * Description of Salary
     * Test the Allowance Add button
     * @author KhinNyeinChanThu
     */
    public function testAllowanceAdd() {

        $this->url('salary/index/allowance');
        $form = $this->byId("TextBoxesGroup");
        $name = $this->byName('textbox1');
        $amount = $this->byName('txt1');
        $name->value('Bonus');
        $amount->value('200000');
        $form->submit();
        $successmesg = $this->byCssSelector('div.successMessage');
        $this->assertEquals('Allowances are added successfully!', $successmesg->text());
    }

    public function testAllowenceEdit() {
        $this->url('/salary/index/allowance');
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byName("name")->displayed();
        }, 2000);
        $this->byName('name')->clear();
        $this->byName('name')->value('bonus');
        $this->byName('allowance_amount')->clear();
        $this->byName('allowance_amount')->value('200');
        $this->byId('edit_allowance_edit')->click();
        sleep(2);
        $str1 = $this->byXPath("//td[contains(text(),'bonus')]");
        $str2 = $this->byXPath("//td[contains(text(),'200')]");
        $this->assertEquals('bonus', $str1->text());
        $this->assertEquals('200', $str2->text());
    }

    public function testDelete() {
        $this->url('/salary/index/allowance');
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byId("all_delete")->displayed();
        }, 2000);
        $this->byId('all_delete')->click();
        $this->assertEquals('Are u sure to delete?', $this->byCssSelector('div#confirm p')->text());
        $submitLink = $this->byXPath("//span[contains(text(),'Yes')]");
        $submitLink->click();
    }

    public function testNotDelete() {
        $this->url('/salary/index/allowance');
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byId("all_delete")->displayed();
        }, 2000);
        $this->byId('all_delete')->click();
        $this->assertEquals('Are u sure to delete?', $this->byCssSelector('div#confirm p')->text());
        $submitLink = $this->byXPath("//span[contains(text(),'No')]");
        $submitLink->click();
    }

    public function testCancel() {
        $this->url('/salary/index/allowance');
        $this->byCssSelector('a.inedit')->click();
        $this->waitUntil(function () {
            return $this->byId("edit_close")->displayed();
        }, 2000);
        $this->byId('edit_close')->click();
        $this->url('salary/index/allowance#');
    }

    public function testSalaryEdit() {
        $this->url('/salary/index/salarylist');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byId('edit_salary');
        $this->byId('baseerr')->clear();
        $this->byId('baseerr')->value('400000');
        $this->byName('radTravel')->value('2');
        $this->byName('travelfee')->clear();
        $this->byName('travelfee')->value('30000');
        $this->byName('overtime')->clear();
        $this->byName('overtime')->value('2000');
        $this->byName('check_list[]')->value('children');
        $this->byName('no_of_children')->value('2');
        $this->byId('edit_salary_edit')->click();
        sleep(2);
        $this->refresh();
        $str1 = $this->byXPath("//td[contains(text(),'400,000')]");
        $str2 = $this->byXPath("//td[contains(text(),'30,000')]");
        $this->assertEquals('400,000', $str1->text());
        $this->assertEquals('30,000', $str2->text());
    }

    public function testSalaryListCancel() {
        $this->url('/salary/index/salarylist');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byId('edit_close')->click();
        $this->url('salary/index/salarylist#');
    }

    public function testDedEdit() {
        $this->url('/salary/index/salarysetting');
        $this->byCssSelector('a.inedit')->click();
        sleep(5);
        $this->byName('taxs_to')->clear();
        $this->byName('taxs_to')->value('5000000');
        $this->byName('ssc_comp')->clear();
        $this->byName('ssc_comp')->value('5');
        $this->byId('edit_tax')->click();
        sleep(2);
        $str1 = $this->byXPath("//td[contains(text(),'5,000,000')]");
        $this->assertEquals('5,000,000', $str1->text());
    }

    public function testLformValidation() {
        $this->url('salary/index/addsalary');
        $this->byId('addsalary')->click();
        sleep(5);
        $this->assertEquals('* Username is required', $this->byCssSelector('span#add_salary_uname_error')->text());
        $this->assertEquals('* Basic Salary is required', $this->byCssSelector('span#add_salary_bsalary_error')->text());
    }

    /**
     * Description of Salary
     * Test the Add Salary CSV upload
     * @author KhinNyeinChanThu
     * 
     */
    public function testAddSalaryCsv() {

        $this->url('salary/index/addsalary');
        sleep(5);
        $addcsvfile = $this->byId('csv_file');
        $addcsvfile->click();
        $browse = $this->byId('csvimport');
        $tmp = (dirname(__DIR__) . '\tmp' . "\salary_data_20160524.csv");
        $this->byId('file_select')->value($tmp);
        $browse->submit();
        sleep(5);
        $this->url('salary/index/addsalary');
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
