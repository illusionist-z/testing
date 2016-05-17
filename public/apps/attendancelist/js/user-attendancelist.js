
 //for pagination
/*
 * show monthly list by return json array
 * @author Su ZIn Kyaw
 */
 var User={};
 User.Attendance = {
    search : function(){
      var startdate = document.getElementById('startdate').value;
      var enddate = document.getElementById('enddate').value;
      //alert(startdate);alert(enddate);
     window.location.href = baseUri + 'attendancelist/user/attendancelist?startdate='+startdate+'&enddate='+enddate;
    }
 };
 
$(document).ready(function () { 
    
    $('#search').on('click',function(){
        //alert("search");
         User.Attendance.search();
    });  
             
});
