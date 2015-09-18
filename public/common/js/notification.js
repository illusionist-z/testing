/**
 * 
 * @type type
 * 
 */
var Noti = {
   
   
    Seen : function(d){
        var form=$('#noti_detail');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : baseUri+"notification/index/update_noti",
            success:function(){
            }
        });
    },
    Accept : function(){
        var form=$('#noti_detail');
        
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : baseUri+ "leavedays/index/acceptleave",
            success:function(){
               
               window.location.href=baseUri+'dashboard';
            }
        });
    },
   
    Reject : function(){
        var form=$('#noti_detail');
       
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : baseUri+"leavedays/index/rejectleave",
            success:function(){ 
                
                window.location.href=baseUri+'dashboard';
            }
        });
    },
    
    NotiDetail: function(d){
         $.ajax({
            type:'POST',
            data: d,
            url : baseUri+"notification/index/detail",
            success:function(){ 
                
            }
        });
    }

};

$(document).ready(function () {
    
    $('#noti_reject').click(function(e){
            Noti.Reject();
            e.preventDefault();
            
             
        }),
        $('#noti_accept').click(function(e){
            Noti.Accept();
            //$ovl.dialog("close");
            
            
             
        }),
        $('#noti_cancel').click(function(e){
            
             
        }),
        $('#noti_ok').click(function(e){
            
            Noti.Seen();
            
             
        });
   
   

    $(".noti").click(function () {
       document.getElementById("noti").className = "noticlose";
       $("#notificationContainer").fadeToggle(100);
       $("#notificationsBody").load(baseUri+'notification/index/notification');
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




