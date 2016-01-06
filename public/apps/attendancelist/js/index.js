/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var pager = new Paging.Pager(),dict =[];   //for pagination

/*
 * show today list by return json array
 * @version 24/8/2015 David
 */
var Attendance = {
        init : function (reload){
            $('tfoot').append($('table.listtbl tbody').html());   //for csv 
            pager.perpage = 8;
            pager.para = $('table.listtbl tbody > tr');
            pager.showPage(1);
            $('tbody').show();
            if(reload){
             $.ajax({
                url:'autolist',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                 // alert(json_obj[i].member_login_name);
                dict.push(json_obj[i].member_login_name);
                }   
                }                        
              }); 
          }
        },
        time_edit : function (id) {            
            $.ajax({
                url : "editTimedialog/"+id,
                type :"GET",   
                dataType : 'json',
                success : function(d){  
                   // alert("aa");
                    $('#edit_att_time').empty();
                    var data = d[0]; 
                    var username = data['member_login_name'];          //get user name
                    var notes = data['notes'];                      //get  reason note
                    n = new Date();
                    offset = n.getTimezoneOffset();
                    if (offset<0){
                    sign='-';
                    value=offset*(-1);
                    }
                    else{
                    value=offset*(-1);
                    sign='+';
                    }
                    checkin = data['checkin_time'].split(" ");
                    b = checkin[1];
                    ds=b.split(":");
                    total=(ds[0]*3600)+(ds[1]*60)+(ds[2]*1);
                    if (sign==='-'){
                    time_diff=total +(value*60);}
                    else{
                    time_diff=total-(value*60);
                    }
                    hours   = Math.floor(time_diff / 3600);
                    minutes = Math.floor((time_diff - (hours * 3600)) / 60);
                    seconds = time_diff - (hours * 3600) - (minutes * 60);

                    if (hours   < 10) {hours   = "0"+hours;}
                    if (minutes < 10) {minutes = "0"+minutes;}
                    if (seconds < 10) {seconds = "0"+seconds;}
                    localcheckin   = checkin[0] +' '+hours+':'+minutes+':'+seconds;
                    
                         var dia_div = '<form id="edit_attendance"><table>'
                                   +'<tr><td><label for="title">'+d[1]['att_time']+'</label></td><td><input  style="margin-top:10px;" size="25" type="text" class="form-control datetimepicker" name="time" id="time" value="'+localcheckin +'"></td></tr>'
                                   +'<tr><td><label for="member_name">'+d[1]['name']+'</label></td><td><input  style="margin-top:10px;" type="text" class="form-control" name="uname" value="'+username+'" disabled></td></tr>'               
                                   +'<tr><td><label for="reason">'+d[1]['note']+'</label></td><td><textarea   style="margin-top:10px;" style="font-size: 13px;"  class="form-control" name="note" disabled>'+ notes +'</textarea></td></tr>'
                                   +'<tr><td></td><td ><input style="margin-top:10px;" type="submit" class="buttonn bcbgcolor" value="'+d[1]['save']+'" id="edit_attendance_edit"> <input style="margin-top:10px;" class="buttonn cbcbgcolor" type="reset" value="'+d[1]['cancel']+'" id="edit_attendance_close"></td></tr>'
                                  +'</table></form>';
                        $('#edit_att_time').append(dia_div);
                        $dia = $('#edit_att_time');
                        $dia.css('color','black');
                        $dia.css('background','#F5F5F5');
                        $dia.dialog({
                            modal :true,
                            height:'auto',
                            width : 'auto',
                            autoOpen: false,
                            title : d[1]['edit_att']
                        });
                      $dia.dialog("open");
                      $('#edit_attendance_close').on('click',function(e){
                          e.preventDefault();
                          $dia.dialog("close");
                          $('#edit_att_time').empty();
                      });
                      $("#edit_attendance_edit").on('click',function(e){
                          e.preventDefault();
                          Attendance.time_edit_btn(id);                        
                        });             
                      $('.datetimepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datetimepicker').datetimepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            showTimezone :false,
                            maskInput : true,                                                                                                         
                           timeFormat: "HH:mm:ss"}).focus();
                       $('#ui-datepicker-div').css('z-index',9999);         //dialog box apperances
                     });                       
               }
      });        
},
         time_edit_btn : function(id) {
           //alert(id);
           localtime=document.getElementById('time').value;           
           window.location.href='editTime/'+id+'/'+localtime;         
       },
       
        todaylist: function (){  
           // $('table.listtbl tbody').empty();
        var name = document.getElementById('namelist').value;        
         
        $.ajax({
        url: 'todaylist?namelist='+name ,
        type: 'GET',
        success: function (d) {
            //alert(d);
         $('body').html(d);
         link_height() ;
         // Attendance.init();
        },
        error: function (d) {
            alert('error');
        }       
       });                 
       },
      monthlylist :function (){
            var yy = $('#year').val(),
             mm = $('#month').val(),
             name = $('#username').val();
        //set empty
        $('table.listtbl tbody').empty(), $('tfoot').empty(), $('div#content').empty();
        
        if ("" === yy && "" === mm && "" === name) {
            var output = "<tr>"
                    + "<td colspan='9'><center>No data to display</center></td>"
                    + "</tr>";
            $("tbody").append(output);
        }
        else {
            $.ajax({
                url: 'attsearch',
                type: 'POST',
                data: {month: mm, username: name, year: yy},      
                cache : false,
                success: function (d) {
                    var json_obj = $.parseJSON(d);//parse JSON                               
                    for (var i in json_obj)
                    {
                        checkin_place = json_obj[i].location;
                        //alert(checkin_place);
                        a = "08:00:00";
                        n = new Date();
                        offset = n.getTimezoneOffset();
                        if (offset < 0) {
                            sign = '-';
                            value = offset * (-1);
                        }
                        else {
                            value = offset * (-1);
                            sign = '+';
                        }

                        checkin = json_obj[i].checkin_time.split(" ");
                        b = checkin[1];
                        ds = b.split(":");
                        total = (ds[0] * 3600) + (ds[1] * 60) + (ds[2] * 1);
                        if (sign === '-') {
                            time_diff = total + (value * 60);
                        }
                        else {
                            time_diff = total - (value * 60);
                        }
                        hours = Math.floor(time_diff / 3600);
                        minutes = Math.floor((time_diff - (hours * 3600)) / 60);
                        seconds = time_diff - (hours * 3600) - (minutes * 60);

                        if (hours < 10) {
                            hours = "0" + hours;
                        }
                        if (minutes < 10) {
                            minutes = "0" + minutes;
                        }
                        if (seconds < 10) {
                            seconds = "0" + seconds;
                        }
                        localcheckin = hours + ':' + minutes + ':' + seconds;
                        //for late 
                        office_stime = "08:00:00";
                        p = json_obj[i].att_date + " ";
                        late = new Date(new Date(p + localcheckin) - new Date(p + office_stime)).toUTCString().split(" ")[4];

                        //for check out time
                        if (json_obj[i].checkout_time !== null) {
                            checkout = json_obj[i].checkout_time.split(" ");
                            out = checkout[1];
                            ds = out.split(":");
                            total = (ds[0] * 3600) + (ds[1] * 60) + (ds[2] * 1);

                            //changing utc time to current timezone
                            if (sign === '-') {
                                time_diff = total + (value * 60);
                            }
                            else {
                                time_diff = total - (value * 60);
                            }
                            hours = Math.floor(time_diff / 3600);
                            minutes = Math.floor((time_diff - (hours * 3600)) / 60);
                            seconds = time_diff - (hours * 3600) - (minutes * 60);

                            if (hours < 10) {
                                hours = "0" + hours;
                            }
                            if (minutes < 10) {
                                minutes = "0" + minutes;
                            }
                            if (seconds < 10) {
                                seconds = "0" + seconds;
                            }


                            localcheckout = hours + ':' + minutes + ':' + seconds;
                            if (checkout[1] > checkin[1]) {
                                workinghour = new Date(new Date(p + checkout[1]) - new Date(p + checkin[1])).toUTCString().split(" ")[4];
                                regularworkinghour = "08:00:00";
                                if (workinghour > regularworkinghour) {
                                    overtime = new Date(new Date(p + workinghour) - new Date(p + regularworkinghour)).toUTCString().split(" ")[4];
                                }
                                else {
                                    overtime = "0";
                                }
                            }
                        }
                        else {
                            localcheckout = "00:00:00";
                            workinghour = "0";
                            overtime = "0";
                        }
                        //Calculate Location

                        var output = "<tr>"
                                + "<td>" + json_obj[i].att_date + "</td>"
                                + "<td>" + json_obj[i].member_login_name + "</td>"
                                + "<td>" + localcheckin + " </td>"
                                + "<td style='color:red'>" + late + "</td>"
                                + "<td>" + json_obj[i].notes + "</td>"
                                + "<td>" + localcheckout + "</td>"
                                + "<td>" + workinghour + "</td>"
                                + "<td>" + overtime + "</td>"
                                + "<td>" + checkin_place + "</td>"
                                + "</tr>";
                        $("tbody").append(output);
                    }                    
                    Attendance.init();
                },
                error: function (d) {
                    alert('error');
                }
            });                        
      }
      }
             
   };
   
$(document).ready(function () {
    Attendance.init('reload');
                      
    $('#namesearch').on('click',function(){
        Attendance.todaylist();
    });              

    $('.tags').on('click',function(){
        $(this).autocomplete({
            source :dict
        })
    });
    
    $('.monthauto').on('click',function(){
        $(this).autocomplete({
            source: dict
        });
    });
    
    $('.listtbl').on("click",".displaypopup",function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        Attendance.time_edit(id);                
    });
  
   $('#sub').unbind('click').bind('click',function (e) {
        e.preventDefault();
        Attendance.monthlylist.apply(this);        
    });   
});


