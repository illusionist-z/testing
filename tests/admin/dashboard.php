<?php

/**
 * Description of dashboard
 * Test the ManageUser,Attendacne,Leave,Salary,Notification,Help, signout and setting,
 * check in ,check out and viewall.
 * Class UnitTest
 * @author KhinNyeinChanThu
 */
class dashboard extends PHPUnit_Extensions_Selenium2TestCase {

    public static $browsers = array(
        array('browserName' => 'firefox', 'sessionStrategy' => 'shared')
    );

    function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://localhost/salts');
    }

    public function testHelpicon() {
        Helper::testLoginSuccess();
        $this->url('index.phtml');
        $helpicn = $this->byId('help_icon');
        $helpicn->click();
        $this->url('help/index/searchHelp');
    }

    public function testNotiicon() {
        Helper::testLoginSuccess();
        $this->url('index.phtml');
        $notiicn = $this->byId('noti');
        $notiicn->click();
    }

//     public function testStaffAtt() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a');
//         $this->url('attendancelist/index/todaylist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("Today Attendance List", $element->text());
//    }
//     public function testStaffAbs() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a')->click();
//         $this->url('attendancelist/absent/absentlist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("Absent Lists", $element->text());
//    }
//    public function testCheck() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $form = $this->byName('theForm');
//        $element = $this->byName('linkemail');
//        $element->click();
//        $this->byCssSelector('textarea')->value("traffic");
//        $this->byCssSelector('.checkin')->click();
//        $this->url('attendancelist/index/todaylist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("Today Attendance List", $element->text());
//    }
//    
//    
//     public function testSucessCheckIn() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a.checkin')->click();
//        $this->assertEquals(' Successfully Checked In', $this->alertText());
//        $this->acceptAlert();
//        $this->url('attendancelist/index/todaylist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("Today Attendance List", $element->text());
//       }
//     public function testAlreadyCheckIn() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a.checkin')->click();
//        $this->assertEquals('You have already check in', $this->alertText());
//        $this->acceptAlert();
//        $this->url('attendancelist/index/todaylist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("Today Attendance List", $element->text());
//       }
//     public function testCheckOut() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a.checkout')->click();
//        $this->assertEquals('Successfully Checked Out', $this->alertText());
//        $this->acceptAlert();
//        $this->url('attendancelist/index/todaylist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("Today Attendance List", $element->text());
//    }
//  
//        public function testViewAll() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a')->click();
//        $this->url('leavedays/index/noleavelist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("People who take no leave", $element->text());
//         }
//    public function testViewAllMember() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('a.uppercase')->click();
//        $this->url('manageuser/index');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals("User Lists", $element->text());
//         }
//         
//       public function testDropdownDb() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//        
//        $this->byCssSelector('a')->click();
//        $this->url('dashboard/index');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals('Dashboard', $element->text());
//     } 
//      public function testDropdownAtt() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//        
//        $this->byCssSelector('a')->click();
//        $this->url('attendancelist/index/todaylist');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals('Today Attendance List', $element->text());
//     } 
//     public function testDropdownMang() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//        
//        $this->byCssSelector('a')->click();
//        $this->url('manageuser/index/index');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals('User Lists', $element->text());
//     } 
//      public function testDropdownLeave() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//        
//        $this->byCssSelector('a')->click();
//        $this->url('');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals('User Lists', $element->text());
//     } 
//     
//     public function testDropdownCalendar() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//        
//        $this->byCssSelector('a')->click();
//        $this->url('calendar/index');
//        $element = $this->byCssSelector('h1');
//        $this->assertEquals('Calendar', $element->text());
//     } 
//     public function testDropdownDocument() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//        
//        $this->byCssSelector('a')->click();
//        $this->url('document/index/letterhead');
//        
//     } 
//        public function testDropdownSsb() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//         $this->byCssSelector('a')->click();
//        $this->url('document/index/letterhead');
//        $this->byCssSelector('a')->click();
//        $this->url('document/index/ssbdocument');
//        
//     } 
//      public function testDropdownTaxDocu() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img')->click();
//         $this->byCssSelector('a')->click();
//        $this->url('document/index/letterhead');
//        $this->byCssSelector('a')->click();
//        $this->url('document/index/taxdocument');
//        
//     } 
//      public function testSetting() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img.img-circle')->click();
//        $this->byCssSelector('div.pull-left')->click();
//        $this->url('setting/index/admin');
//        
//      }
//      public function testSignOut() {
//        Helper::testLoginSuccess();
//        $this->url('index.phtml');
//        $this->byCssSelector('img.img-circle')->click();
//        $this->byId('btn_logout')->click();
//        $this->url('salts/auth');
//        
//      }
}
