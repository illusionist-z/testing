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
            //alert('success');
            // var myJsonString = JSON.stringify(d);
//            
            //$("#content").html(d);
            //console.log(d);
            //var string = JSON.stringify(d)

            var json_obj = $.parseJSON(d);//parse JSON
            //alert(json_obj);
            $("tbody").empty();
            for (var i in json_obj)
            {
                //alert(json_obj[i].date);
                var output = "<tr>"
                        + "<td>" + json_obj[i].date + "</td>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + json_obj[i].start_date + "</td>"
                        + "<td>" + json_obj[i].end_date + "</td>"
                        + "<td>" + json_obj[i].leave_days + "</td>"
                        + "<td>" + json_obj[i].leave_category + "</td>"
                        + "<td>" + json_obj[i].leave_description + "</td>"
                        + "<td>" + json_obj[i].leave_status + "</td>"
                        + "<td>" + json_obj[i].leave_status + "</td>"
                        + "</tr>"
                $("tbody").append(output);
            }


        },
        error: function (d) {
            alert('error');
        }
    });
}
