
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
       $('table.listtbl tbody').empty(), $('tfoot').empty(),$('ul.pagination').empty();   
       if ("" === startdate && "" === enddate) {
            var output = "<tr>"
                    + "<td colspan='9'><center>No data to display</center></td>"
                    + "</tr>";
            $("tbody").append(output);
        }
        else {
            window.location.href = baseUri + 'attendancelist/user/attendancelist?startdate='+startdate+'&enddate='+enddate;
        }
    }
 };
 
$(document).ready(function () { 
    
    $('#search').on('click',function(){
        //alert("search");
         User.Attendance.search();
    });  
             
});
