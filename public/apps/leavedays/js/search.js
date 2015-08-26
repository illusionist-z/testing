/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @version 8/24/2015 David
 * @LeaveListSearch @function
 */
var Leave = {
    Search : function()
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

                    var json_obj = $.parseJSON(d);//parse JSON
                    var leave_left="";
                    //alert(json_obj);
                    $("tbody").empty();
                    for (var i in json_obj)
                    {
                        if(json_obj[i].total_leavedays>=json_obj[i].max_leavedays){

                                   leave_left= json_obj[i].total_leavedays-json_obj[i].max_leavedays;

                            }
                         else{
                             leave_left=json_obj[i].max_leavedays-json_obj[i].total_leavedays;
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
                                + "<td>" + json_obj[i].leave_status + "</td>"
                                + "<td style='color:red;'>" + leave_left + " left</td>"
                                + "</tr>";
                        $("tbody").append(output);
                    }
                    init();
                },
                error: function (d) {
                    alert('error');
                }
            });
        }
};
