/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @version 8/24/2015 David
 * @LeaveListSearch @function
 */

     function search_list()
            {
            var leave_type = document.getElementById('ltype').value;
            var month = document.getElementById('month').value;
            var namelist = document.getElementById('namelist').value;
            //window.location.href = baseUri + 'leavedays/search?ltype='+leave_type+'&month='+month+'&namelist='+namelist;
            //  var $form = $('#frm_search');
                 if(leave_type=="" && month=="" && namelist==""){
                        $('tbody').empty();
                        var output = "<tr>"
                                       + "<td colspan='9'><center>No data to display</center></td>"                           
                                       + "</tr>"
                               $("tbody").append(output);                  
                }
            else{
                 $.ajax({
                url: baseUri + 'leavedays/search?ltype=' + leave_type + '&month=' + month + '&namelist=' + namelist,
                type: 'GET',
                success: function (d) {    
                  
                    var json_obj = $.parseJSON(d);//parse JSON      
                    var leave_left="";
                    //alert(json_obj);
                    $("tbody").empty();
                    $("tfoot").empty();
                     var  status;
                    for (var i in json_obj)
                    { var max=json_obj[i].max_leavedays; 
                      var tl=json_obj[i].total_leavedays;
                        //alert(tl);
                        if(max<tl){

                                   leave_left= json_obj[i].total_leavedays-json_obj[i].max_leavedays;
                                    status=" Days In Absent";

                            }
                          else{
                             leave_left=json_obj[i].max_leavedays-json_obj[i].total_leavedays;
                              status=" Left";
                         }
                         var leave_status;
                         if(json_obj[i].leave_status==='0'){
                            leave_status =" Pending";
                         }
                         else if(json_obj[i].leave_status==='1'){
                             leave_status =" Confirmed";
                         }
                         else{
                             leave_status =" Rejected";
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
                                + "<td>" + leave_status + "</td>"
                                + "<td style='color:red;'>" +leave_left +status+ "</td>"
                                + "</tr>";
                        $("tbody").append(output);
                    }
                    Leave.init();
                },
                error: function (d) {
                    alert('error');
                }
            });
            }
           
        }

