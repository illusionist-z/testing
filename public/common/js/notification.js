/**
 * 
 * @type type
 * Notification For Admin And User
 * @author Su Zin Kyaw <suzinkyaw.gnext@gmail.com>
 */
var baseUri;
var Noti = {
    Seen: function(d) {
        var form = $('#noti_detail');
        
        $.ajax({
            type: 'POST',
            data: form.serialize(),
            url: baseUri + "notification/index/updateNoti",
            success: function() {
                window.location.href = baseUri + 'dashboard';

            }
        });
    },
    Accept: function() {
        var form = $('#noti_detail');        
       
                $.ajax({
                    type: 'POST',
                    data: form.serialize(),
                    url: baseUri + "leavedays/index/acceptleave",
                    success: function() {
                  window.location.href = baseUri + 'dashboard';
                    }
                });
        
        
    },
    Reject: function() {
        var form = $('#noti_detail');
      
                $.ajax({
                    type: 'POST',
                    data: form.serialize(),
                    url: baseUri + "leavedays/index/rejectleave",
                    success: function() {

                        window.location.href = baseUri + 'dashboard';
                    }
                });
               
        
    }


};

$(document).ready(function() {

    $('#noti_reject').on('click',function(e){
        Noti.Reject();
        e.preventDefault();
    }),
            $('#noti_accept').on('click',function(){
        Noti.Accept();
    }),
            $('#noti_ok').on('click',function(){
        Noti.Seen();
    });



    $(".noti").on('click',function(e){
        e.preventDefault();
        //document.getElementById("noti").className = "noticlose";
        $("#notificationContainer").fadeToggle(100);
        $("#notificationsBody").load(baseUri + 'notification/index/notification');
    });


    $(".content").on('click',function(){
        $("#notificationContainer").hide();
        
    });




});
