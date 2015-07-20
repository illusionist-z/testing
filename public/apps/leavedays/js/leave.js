/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */

$(document).ready(function () {
    var userUri = baseUri + 'leavedays/';

    $('#frm_search').submit(function () {
        search();
    });
});


function search()
{
    var leave_type = document.getElementById('ltype').value;
    var month = document.getElementById('month').value;
    var namelist = document.getElementById('namelist').value;
    //window.location.href = baseUri + 'leavedays/search?ltype='+leave_type+'&month='+month+'&namelist='+namelist;
//  var $form = $('#frm_search');
    $.ajax({
        url: baseUri + 'leavedays/search?ltype=' + leave_type + '&month=' + month + '&namelist=' + namelist,
        type: 'GET',
        success: function (d) {
            alert("success");
          // var myJsonString = JSON.stringify(d);
//            
             //$("#content").html(d);
            //console.log(d);
            
	    var json_obj = $.parseJSON(d);//parse JSON
            
            
            for (var i in json_obj) 
            {
                var output="<tr>";
                output+="<td>" + json_obj[i].date + "</td>";
                output+="<td>" + json_obj[i].member_login_name + "</td>";
                output+="<td>" + json_obj[i].start_date + "</td>";
                output+="<td>" + json_obj[i].end_date + "</td>";
                output+="<td>" + json_obj[i].leave_days + "</td>";
                output+="<td>" + json_obj[i].leave_category + "</td>";
                output+="<td>" + json_obj[i].leave_description + "</td>";
                output+="<td>" + json_obj[i].leave_status + "</td>";
                output+="<td>" + json_obj[i].leave_status + "</td>";
                output+="</tr>";
            }
            
            $("tbody").html(output);
        },
        error: function (d) {
            alert('error');
        }
    });
}
