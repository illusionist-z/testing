
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
      var startdate = document.getElementById('startdate').value;
      var enddate = document.getElementById('enddate').value;
      //alert(startdate);alert(enddate);
     window.location.href = baseUri + 'attendancelist/user/attendancelist?startdate='+startdate+'&enddate='+enddate;
    }
 };
 
$(document).ready(function () { 
    
    User.Attendance.init();
    
    $('#search').click(function () {
        //alert("search");
         User.Attendance.search();
    });  
             
});

