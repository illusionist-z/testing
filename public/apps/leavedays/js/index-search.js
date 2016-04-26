/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @version 8/24/2015 David
 * @LeaveListSearch @function
 */

function search_list(p)
{
    var leave_type = document.getElementById('ltype').value;
    var month = document.getElementById('month').value;
    var namelist = document.getElementById('namelist').value;
    //window.location.href = baseUri + 'leavedays/search?ltype='+leave_type+'&month='+month+'&namelist='+namelist;
    var pg = (typeof p == "undefined" ? 0 : p);
    if (leave_type == "" && month == "" && namelist == "") {
        $('tbody').empty();
        var output = "<tr>"
                + "<td colspan='9'><center>No data to display</center></td>"
                + "</tr>";
        $("tbody").append(output);
    }
    else {
        loadingMsg(true);
        $.ajax({
            url: baseUri + 'leavedays/search',
            data : {ltype : leave_type,month:month,namelist : namelist,page : pg},
            type: 'GET',
            success: function (d) {
                //alert(d);
                var json_obj = $.parseJSON(d);//parse JSON      
                var leave_left = "";
                //alert(json_obj);
                $("tbody").empty();
                $("tfoot").empty();$("ul.pagination").empty();
                var status = '';
                for (var i in json_obj.items)
                {
                    var max = parseInt(json_obj.items[i].max_leavedays);
                    var tl = parseInt(json_obj.items[i].total_leavedays);
                    //alert(tl);
                    if (max < tl) {

                        leave_left = json_obj.items[i].total_leavedays - json_obj.items[i].max_leavedays;
                        status = " Absent";

                    }
                    else {
                        leave_left = json_obj.items[i].max_leavedays - json_obj.items[i].total_leavedays;
                        status = "";
                    }
                    var leave_status;
                    if (json_obj.items[i].leave_status === '0') {
                        leave_status = " Pending";
                    }
                    else if (json_obj.items[i].leave_status === '1') {
                        leave_status = " Confirmed";
                    }
                    else {
                        leave_status = " Rejected";
                    }
                    //alert(json_obj[i].date);
                    var output = "<tr>"
                            + "<td>" + json_obj.items[i].date + "</td>"
                            + "<td>" + json_obj.items[i].member_login_name + "</td>"
                            + "<td>" + json_obj.items[i].start_date + "</td>"
                            + "<td>" + json_obj.items[i].end_date + "</td>"
                            + "<td>" + json_obj.items[i].leave_days + "</td>"
                            + "<td>" + json_obj.items[i].leave_category + "</td>"
                            + "<td>" + json_obj.items[i].leave_description + "</td>"
                            + "<td>" + leave_status + "</td>"
                            + "<td style='color:red;'>" + leave_left + status + "</td>"
                            + "</tr>";
                    $("tbody").append(output);
                }
                if(json_obj.last != 0 && json_obj.last != 1){
                    var paginglink = '  <li><a href="#" onclick="search_list()">First</a></li><li><a href="#" onclick="search_list('+json_obj.before+')">Previous</a></li>'
                    +'<li><a href="#" onclick="search_list('+json_obj.next+')">Next</a></li><li><a href="#" onclick="search_list('+json_obj.last+')">Last</a></li>'
                    +'<li><span class="btn" style="margin-left:20px;">You are in page '+ json_obj.current+' of '+ json_obj.total_pages +'</span></li>';
                $('ul.pagination').append(paginglink);
                }
                Leave.init();
                loadingMsg(false);
            },
            error: function (d) {
                alert('error');
            }
        });
    }

}

