
var Noti = {
    isOvl:false,
    Detail: function (id) {
        $.ajax({
            type: 'GET',
            url: '../../notification/index/detail?data=' + id,
            dataType: 'html',
            success: function (res) {
               
                Noti.Dialog(res);     
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
            height: 370,
            async:false,
            width: 800,
            modal: true,
            title:""
        });                
        $ovl.html(data);
        $ovl.dialog("open");
        // user edit button
        $('#accept').click(function(){
          Decide();
        });
        $('#notidetail_cancel').click(function(e){
            e.preventDefault();
            $ovl.dialog("close");
            this.isOvl=false;
        });
        // user delete button
        $('#reject').click(function(){
           Decide();
        });
    },
    /**
     * @param {type} user id
     * @desc  update user data
     */
   
  
    /**     
     * @desc confirmation delete
     */
    
};
$(document).ready(function () {
    $(".notidetail").click(function () {
        
        var id = $(this).attr('id');
        Noti.Detail(id);
    });    
    
});        
 var Decide=function(){
     alert("Decide");
       var username = document.getElementById('username').value; 
       
       
         window.location.href = baseUri + 'manageuser/user/userlist?username='+username;
    };