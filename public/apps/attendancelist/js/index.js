/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */

       
$(document).ready(function(){        
   
    // ユーザーのクリックした時の動作。

    
    $('#search').click(function(){
        search();
    });
    
      $('#sub').click(function(){
          sub();
    });
    
     $('#namesearch').click(function(){
        namesearch();
    });
});

    var search=function(){
       var month = document.getElementById('month').value;
      
         window.location.href = baseUri + 'attendancelist/user/attendancelist?month='+month;
    };
    
     var sub=function(){
       var month = document.getElementById('month').value;  
       var username = document.getElementById('username').value; 
       var year = document.getElementById('year').value; 
        // window.location.href = baseUri + 'attendancelist/index/monthlylist?month='+month+'&username='+username+'&year=' +year;
         $.ajax({
        url: baseUri + 'attendancelist/search/attsearch?month='+month+'&username='+username+'&year=' +year,
        type: 'GET',
        success: function (d) {
            //alert(d);
            
            var json_obj = $.parseJSON(d);//parse JSON
            $("tbody").empty();
            for (var i in json_obj)
            {
                alert(json_obj[i].date);
                var output = "<tr>"
                        + "<td>" + json_obj[i].att_date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "<td>" + json_obj[i].checkin_time + "</td>"
                        + "</tr>"
                $("tbody").append(output);
            }

        },
        error: function (d) {
            alert('error');
        }
    });
    };
    
     var namesearch=function(){
       var namelist = document.getElementById('namelist').value;  
      
         window.location.href = baseUri + 'attendancelist/index/todaylist?namelist='+namelist;
    };
