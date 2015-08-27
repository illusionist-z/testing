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
               
               var data ='<form id="noti_detail" width="650px" height="300px"><table width="650px" height="300px">';               
                   data += '<tr><td>User Name :</td><td>'+result[0]['member_login_name']+ '</td>'
                        +'<td>Start Date:</td><td>'+result[0]['start_date']+ '</td></tr>'
                        +'<td>End Date:</td><td>'+result[0]['end_date']+ ' </td></tr>'
                        +'<td>Leave Status:</td><td>'+result[0]['leave_status']+ '</td></tr>'
                        +'<td>Leave Days:</td><td>'+result[0]['leave_days']+ '</td></tr>'
                        +'<td>Leave Description:</td><td>'+result[0]['leave_description']+ '</td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['member_id']+ ' name="id"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['start_date']+ ' name="start_date"></td><td></td></td></tr>';             

               data +='<tr><td></td><td colspan="2"><a href="#" class="button" id="noti_ok">OK</a></td></tr>';
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
                 var result = $.parseJSON(res);
               var data ='<form id="noti_detail" width="650px" height="300px"><table width="650px" height="300px">';               
                   data += '<tr><td>User Name :</td><td>'+result[0]['member_login_name']+ '</td>'
                        +'<td>Start Date:</td><td>'+result[0]['start_date']+ '</td></tr>'
                        +'<td>End Date:</td><td>'+result[0]['end_date']+ ' </td></tr>'
                        +'<td>Leave Status:</td><td>'+result[0]['leave_status']+ '</td></tr>'
                        +'<td>Leave Days:</td><td>'+result[0]['leave_days']+ '</td></tr>'
                        +'<td>Leave Description:</td><td>'+result[0]['leave_description']+ '</td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['member_id']+ ' name="id"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['end_date']+ ' name="end_date"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['leave_days']+ ' name="leave_days"></td><td></td></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['start_date']+ ' name="start_date"></td><td></td></td></tr>';             

               data +='<tr><td colspan="2"><a href="#" class="button" id="noti_accept">Accept</a><a href="#" class="button" id="noti_reject">Reject</a><a href="#" class="button" id="noti_cancel">Cancel</a></td></tr>';
               data +='</table></form>';
               Noti.Dialog(data);    
            }
        });
    },
    Dialog: function (data) {
        if(!this.isOvl){
            this.isOvl=true;
        }
        $ovl = $('#notidetail');
        $ovl.dialog({
            
            autoOpen: false,
            height: 420,
            async:false,
            width: 800,
            modal: true,
            title:"Your Notifications"
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
            //$('body').load(dashboard);
            this.isOvl=false;
             
        }),
        $('#noti_cancel').click(function(e){
            
            e.preventDefault();
            $ovl.dialog("close");
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
            }
        });
    },
    Refresh : function(d){
        var form=$('#noti_detail');
        
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "../../leavedays/index/acceptleave",
            success:function(){
               
                d.dialog("close");
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
    
});        
