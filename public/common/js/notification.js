
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
//        $('#accept').click(function(){
//          Accept();
//        });
        $('#notidetail_cancel').click(function(e){
            e.preventDefault();
            $ovl.dialog("close");
            $('body').load(window.location.href);
            this.isOvl=false;
             
        });
//        // user delete button
//        $('#reject').click(function(){
//           Reject();
//        });
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
// var Accept=function(){
//   
//       var id = document.getElementById('id').innerHTML; 
//       var sdate=document.getElementById('sdate').innerHTML;
// 
//      
//       window.location.href = baseUri + 'leavedays/index/acceptLeave?id='+id+'&sdate'+sdate;
//         
//    };
// var Reject=function(){
//   
//       var id = document.getElementById('id').innerHTML; 
//       var sdate=document.getElementById('sdate').innerHTML;
//         window.location.href = baseUri + 'leavedays/index/rejectLeave?id='+id +'&sdate'+sdate;
//    };