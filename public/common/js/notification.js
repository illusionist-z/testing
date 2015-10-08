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
               window.location.href=baseUri+'dashboard';

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
      Calendar : function(id){
     
      $.ajax({
            type:'POST',
            data:  {id : id},
            url : baseUri+"notification/index/noticalendar",
            success:function(){ 
                window.location.href=baseUri+'calendar/index';
            }
        });
    },
     Attendances : function(id){
     
      $.ajax({
            type:'POST',
            data:  {id : id},
            url : baseUri+"notification/index/notiattendances",
            success:function(){ 
                window.location.href=baseUri+'attendancelist/index/todaylist';
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
      
        }),
       
        $('#noti_ok').click(function(e){
            
            Noti.Seen();
        });
        $('.calendar').click(function(e){
            var id=$(this).attr('id');
          //  alert(id);
           Noti.Calendar(id);
        });
        $('.attendances').click(function(e){
            var id=$(this).attr('id');
          //  alert(id);
           Noti.Attendances(id);
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




