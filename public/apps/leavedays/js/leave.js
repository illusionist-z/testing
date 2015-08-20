/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */
var pager = new Paging.Pager();
/*
*search list leave
*@author David
*/
var searchleavelist=function(){     
        var month = document.getElementById('month').value; 
        var ltype = document.getElementById('ltype').value;      
         $.ajax({
             type:"GET",
             url :baseUri + 'leavedays/user/leavelist?month='+month+'&ltype='+ltype,
             success:function(val){                 
                  $('body').html(val);
             }
         });
    };
    
$(document).ready(function () {
    var userUri = baseUri + 'leavedays/';       
    $("tfoot").html($('tbody').html()); //for csv
       //paging function
       pager.perpage =3;            
       pager.para = $('tbody > tr');
       pager.showPage(1);        
    $('#frm_search').submit(function () {        
        search();
    });
      $('#usersearch').click(function(){        
        searchleavelist();
    });
});


function search()
{
    var leave_type = document.getElementById('ltype').value;
    var month = document.getElementById('month').value;
    var namelist = document.getElementById('namelist').value;
    
    /**
     * @version 18/8/15 David 
     * @desc    Get LeaveList by name
     */
    
    $.ajax({
        url: baseUri + 'leavedays/search?ltype=' + leave_type + '&month=' + month + '&namelist=' + namelist,
        type: 'GET',
        success: function (d) {         
            var json_obj = $.parseJSON(d);//parse JSON
            //alert(json_obj);
            $("tbody").empty();
            $("tfoot").empty();
            for (var i in json_obj)
            {
                switch(json_obj[i].leave_status){
                    case "0": this.status="Pending";break;
                    case "1": this.status="Confirmed";break;
                    case "2": this.status="Rejected";break;
                }
                if(json_obj[i].total_leavedays > 16){                    
                    this.total_leave = json_obj[i].total_leavedays - 16;
                    this.total_leave += "Days are in absent";
                }
                else{                    
                    this.total_leave = 16 - json_obj[i].total_leavedays;                    
                }
                //alert(json_obj[i].date);
                var output = "<tr>"
                        + "<td>" + json_obj[i].date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + json_obj[i].start_date + "</td>"
                        + "<td>" + json_obj[i].end_date + "</td>"
                        + "<td>" + json_obj[i].leave_days + "</td>"
                        + "<td>" + json_obj[i].leave_category + "</td>"
                        + "<td>" + json_obj[i].leave_description + "</td>"
                        + "<td>" + this.status + "</td>"
                        + "<td><font color='red'>" + this.total_leave + "</font></td>"
                        + "</tr>";
                $("tbody").append(output);
                $("tfoot").append(output); // for csv
            }           
       pager.perpage =3;            
       pager.para = $('tbody > tr');
       pager.showPage(1); 
        },
        error: function (d) {
            alert('error');
        }
    });
}
