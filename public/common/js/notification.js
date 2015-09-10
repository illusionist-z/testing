/**
 * 
 * @type type
 * 
 */
var Noti = {
    isOvl:false,
    Detail: function (id) {
       
        $.ajax({
            type: 'GET',
            url: '../../notification/index/detail?data=' + id,
            dataType: 'html',
            success: function (res) {
                 var result = $.parseJSON(res);
               
               var data ='<form id="noti_detail" width="650px" height="300px"><table width="500px" height="300px">';               
                   data += '<tr><td>User Name </td><td style="font-size:13px;">'+result[0]['member_login_name']+ '</td></tr>'
                        +'<td>Start Date </td><td style="font-size:13px;">'+result[0]['start_date']+ '</td></tr>'
                        +'<td>End Date </td><td style="font-size:13px;">'+result[0]['end_date']+ ' </td></tr>'
                        +'<td>Leave Status </td><td style="font-size:13px;">'+result[0]['leave_status']+ '</td></tr>'
                        +'<td>Leave Days </td><td style="font-size:13px;">'+result[0]['leave_days']+ '</td></tr>'
                        +'<td>Leave Description</td><td style="font-size:13px;">'+result[0]['leave_description']+ '</td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['member_id']+ ' name="id"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['start_date']+ ' name="start_date"></td><td></td></td></tr>';             

               data +='<tr><td></td><td colspan="2"><a href="#" class="button" id="noti_ok">OK</a><a href="#" class="button" id="noti_cancel">Cancel</a></td></tr>';
               data +='</table></form>';
               Noti.Dialog(data);    
            }
        });
    },
    AdminDetail: function (id) {
        $.ajax({
            type: 'GET',
            url: '../../notification/index/detail?data=' + id,
            dataType: 'html',
            success: function (res) {
              /* var result = $.parseJSON(res);
               var data ='<form id="noti_detail" width="800px" height="300px"><table width="500px" height="300px" align="center"  >';               
                   data +=  '<td></td><td></td>'
                           +'<tr><td><b>User Name </b></td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['member_login_name']+ '</b></td></tr>'
                        +'<td><b>Start Date </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['start_date']+ '</b></td></tr>'
                        +'<td><b>End Date </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['end_date']+ '</b></td></tr>'
                        +'<td><b>Leave Status </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['leave_status']+ '</b></td></tr>'
                        +'<td><b>Leave Days </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['leave_days']+ '</b></td></tr>'
                        +'<td><b>Leave Description </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['leave_description']+ '</b></td></tr>'
                        
               data +='<tr><td></td><td colspan="2"><a href="#" class="button" id="noti_accept">Accept</a><a href="#" class="button" id="noti_reject">Reject</a><a href="#" class="button" id="noti_cancel">Cancel</a></td></tr>';
               data +='</table></form>';
               Noti.Dialog(data);   */
               
               var result = $.parseJSON(res);  
             
               var data ='<form id="noti_detail" width="800px" height="300px" ><table width="500px" height="290px"  >';               
                   data += '<br>'
                        +'<tr><td></td><td><b>User Name </b></td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['member_login_name']+ '</b></td><td ></td></tr>'
                        +'<tr><td></td><td><b>Start Date </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['start_date']+ '</b></td></tr>'
                        +'<tr><td></td><td><b>End Date </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['end_date']+ '</b></td></tr>'
                        +'<tr><td></td><td><b>Leave Status </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['leave_status']+ '</b></td></tr>'
                        +'<tr><td></td><td><b>Leave Days </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['leave_days']+ '</b></td></tr>'
                        +'<tr><td></td><td><b>Leave Description </b> </td><td><span style="color:black"><b> :</b> </span><b style="font-size:13px;">'+result[0]['leave_description']+ '</b></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['member_id']+ ' name="id"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['end_date']+ ' name="end_date"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['leave_days']+ ' name="leave_days"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['start_date']+ ' name="start_date"></td><td></td></td></tr>';
               data +='<tr><td></td><td></td><td colspan="2"><br><a href="#" class="button" id="noti_accept">Accept</a><a href="#" class="button" id="noti_reject">Reject</a><a href="#" class="button" id="noti_cancel">Cancel</a></td></tr>';
               data +='</table></form>';
               Noti.Dialog(data);
            }
        });
    },
    Dialog: function (data) {
         $("#notificationContainer").hide();
        if(!this.isOvl){
            this.isOvl=true;
        }
        $ovl = $('#notidetail');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            
            autoOpen: false,
            resizable:false,
            height: 395,
            async:false,
            width: 530,            
            modal: true,
            title:"Your Notifications",
           /* show:{
                effect:"blind",//effect:"blind",
		duration:200
	    },
            hide:{
		effect:"explode",
		duration:200
	    }*/
            
            
        });
       
        $ovl.html(data);
        $ovl.dialog("open");
        $('#noti_reject').click(function(e){
            Noti.Reject($ovl);
            e.preventDefault();
            //$ovl.dialog("close");
            //$('body').load(dashboard);
            this.isOvl=false;
             
        }),
        $('#noti_accept').click(function(e){
            Noti.Accept($ovl);
            e.preventDefault();
            //$ovl.dialog("close");
            
            this.isOvl=false;
             
        }),
        $('#noti_cancel').click(function(e){
            
            e.preventDefault();
            $ovl.dialog("close");
            location.reload();
            //$('body').load(dashboard);
            this.isOvl=false;
             
        }),
        $('#noti_ok').click(function(e){
            Noti.Seen($ovl);
            e.preventDefault();
            //$ovl.dialog("close");
            //$('body').load(dashboard);
            this.isOvl=false;
             
        });

    },
    Seen : function(d){
        var form=$('#noti_detail');
       
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "../../notification/index/update_noti",
            success:function(){
                
                d.dialog("close");
                location.reload();
            }
        });
    },
    Accept : function(d){
        var form=$('#noti_detail');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "../../leavedays/index/acceptleave",
            success:function(){
               
                d.dialog("close");
                location.reload();
            }
        });
    },
   
    Reject : function(d){
        var form=$('#noti_detail');
        
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "../../leavedays/index/rejectleave",
            success:function(){ 
                d.dialog("close");
                location.reload();
            }
        });
    }

};

$(document).ready(function () {
   
    
    $(".usernotidetail").click(function () {
       
        var id = $(this).attr('id');
        Noti.Detail(id);
    });   
     $(".adminnotidetail").click(function () {
       
        var id = $(this).attr('id');
        Noti.AdminDetail(id);
    }); 

    $(".noti").click(function () {
       document.getElementById("noti").className = "noticlose";
       $("#notificationContainer").fadeToggle(100);
       $("#notificationsBody").load('../../notification/index/notification');
    });
    
    
    $(".noticlose").click(function () {
       $("#notificationContainer").hide();
       document.getElementById("noti").className = "noti";
       location.reload();
    });
 
//    $(".content").click(function()
//    {
//     $("#notificationContainer").hide();
//    location.reload();
//    });

    
});     




