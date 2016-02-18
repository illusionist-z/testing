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
    }

    public function testTitle() {

        $this->url('index.php');
        $this->assertEquals('Login', $this->title());
    }

    /**
     * Description of Salary
     * Test the Salary in Dashboard
     * @author KhinNyeinChanThu
     * 
     */
    public function testChecksalary() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');
        $this->assertEquals('Salary', $this->title());
        $this->url('salary/index/salarylist');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Salary Lists', $element->text());
    }

    /**
     * Description of Salary
     * Test the Salary List 
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryList() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/salarylist');
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

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $form = $this->byId('frm_search');
        $searchform = $this->byId('search');
        $saluser = $this->byName('username');
        $salperfees = $this->byName('travel_fees');
        $saluser->value('Euser');
        $salperfees->value('Travel fees per day');
        $searchform->click();
        $this->url('salary/index/salarylist');
    }

    /**
     * Description of Salary
     * Test the Salary List Export button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryListExport() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');
        $this->byCssSelector('a')->click();
        $this->url('salary/index/salarylist');
        $this->byLinkText('Export')->click();
        $this->url('salary/index/salarylist');
    }

    /**
     * Description of Salary
     * Test the Add Salary
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryAdd() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
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

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/addsalary');

        $form = $this->byId('add_salary');
        $apply = $this->byId('addsalary');

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
        $apply->click();
        $this->url('salary/index/salarylist');
    }

    /**
     * Description of Salary
     * Test the Add Salary Cancel button
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryCancelform() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/addsalary');

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
     * Test the Add Salary Validation of Add Form
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalaryValidationform() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/addsalary');

        $form = $this->byId('add_salary');
        $apply = $this->byId('addsalary');

        $apply->click();
        sleep(5);
        $uname = $this->byId('add_salary_uname_error');
        $this->assertEquals('* Username is required', $uname->text());
        $bsalary = $this->byId('add_salary_bsalary_error');
        $this->assertEquals('* Basic Salary is required', $bsalary->text());
        $check = $this->byId('add_salary_ssc_error');
        $this->assertEquals('* Check is required', $check->text());
    }

    /**
     * Description of Salary
     * Test the Add Salary CSV upload
     * @author KhinNyeinChanThu
     * 
     */
    public function testAddSalaryCsv() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/addsalary');
        $addcsvfile = $this->byId('csv_file');
        $addcsvfile->click();
        $browse = $this->byId('file_select');
        $browse->click();
        $browse->value('tests\sample.txt');
        $add = $this->byId('csvtosql');
        $add->click();
        $this->url('salary/index/addsalary');
    }

    /**
     * Description of Salary
     * Test the Add Salary CSV download
     * @param type $euser
     * @author KhinNyeinChanThu
     * 
     */
    public function testAddSalaryDownload() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/addsalary');
        $this->byId('csv_download')->click();
        $this->url('salary/index/addsalary');
    }

    /**
     * Description of Salary
     * Test the Monthly Salary
     * @author KhinNyeinChanThu
     * 
     */
    public function testMonthlySalary() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
        $this->url('salary/index/monthlysalary');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Monthly Salary List', $element->text());
    }

    /**
     * Description of Salary
     * Test the Monthly Salary Export button
     * @author KhinNyeinChanThu
     * 
     */
    public function testMonthlySalaryExport() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();

        $this->byCssSelector('a')->click();
        $this->url('salary/index/monthlysalary');
        $this->byLinkText('Export')->click();
        $this->url('salary/index/monthlysalary');
    }

    /**
     * Description of Salary
     * Test the Salary Setting
     * @author KhinNyeinChanThu
     * 
     */
    public function testSalarySetting() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->url('salary/index/salarylist');

        $this->byCssSelector('a')->click();
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

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();

        $this->byCssSelector('a')->click();
        $this->url('salary/index/salarysetting');
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

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();

        $this->byCssSelector('a')->click();
        $this->url('salary/index/salarysetting');
        $this->byLinkText('deduction')->click();
        $this->url('salary/index/salarysetting');
    }

    /**
     * Description of Salary
     * Test the Allowance
     * @author KhinNyeinChanThu
     */
    public function testAllowance() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();
        $this->byCssSelector('a')->click();
        $this->url('/salary/index/allowance');
        $element = $this->byCssSelector('h1');
        $this->assertEquals('Allowance', $element->text());
    }

    /**
     * Description of Salary
     * Test the Allowance Add button
     * @author KhinNyeinChanThu
     */
    public function testAllowanceAdd() {

        $this->url('index.phtml');
        $salarychk = $this->byId('pointer_style3');
        $salarychk->click();

        $this->byCssSelector('a')->click();
        $this->url('/salary/index/allowance');

        $add = $this->byId('alladd');
        $name = $this->byName('textbox1');
        $amount = $this->byName('txt1');
        $name->value('Bonus');
        $amount->value('200000');
        $add->click();
        $successmesg = $this->byCssSelector('.successMessage');
        $this->assertEquals('Allowances are added successfully!', $successmesg->text());
    }

    public function onNotSuccessfulTest(Exception $e) {
        throw $e;
    }

}
