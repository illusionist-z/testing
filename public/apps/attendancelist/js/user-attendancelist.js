/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 //for pagination
/*
 * show monthly list by return json array
 * @author Su ZIn Kyaw
 */
 var User={},pager = new Paging.Pager();
 User.Attendance = {
    init : function(){
            $('tfoot').html($('tbody').html());   //for csv
            pager.perpage =7;            
            pager.para = $('tbody > tr');
            pager.showPage(1);  
            $('tbody').show();
    },
    search : function(){
      var month = document.getElementById('month').value;
     
     window.location.href = baseUri + 'attendancelist/user/attendancelist?month='+month;
    }
 };
 
$(document).ready(function () { 
    
    User.Attendance.init();
    
    $('#search').click(function () {
         User.Attendance.search();
    });  
             
});
