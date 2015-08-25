/**
 * 
 * @author David 
 * @since 25/8/2015
 * @desc adduser form validation
 */
var UserAdd = {
     Submit : function (){
        $.ajax({
            type:'POST',
            url :'../coremember/saveuser',
            data:$("#saveuser").serialize(),
            success: function(){
                
            }
        });
     }    
};
$(document).ready(function(){
    
   $('.submit_useradd').click(function(){
            //validform();   
            UserAdd.Submit();
      
   });
   
 
});
function validform(){
    this.uname = $("#uname").val()==="" ? false:true;
    this.pass = $("#pass").val()==="" ? false:true;
    this.dept = $("#dept").val()==="" ? false:true;
    this.position = $("#pos").val()==="" ? false:true;        
    this.mail = $("#mail").val()===""? false:true;
    this.pno =  /[0-9-()+]{3,20}/g.test($("#pno").val())? true:false;    
    $('#user-error').empty();$('#pass-error').empty();$('#dept-error').empty();$("#pos-error").empty();$("#mail-error").empty();$('#pno').empty();
    if(false===this.uname || false===this.position || false===this.pass || false===this.dept || false === this.mail || false === this.pno){
        
        if(false===this.uname) {$("#uname").css({border:"1px solid red",color:"red"});
                                $('#user-error').text('*Name must be Select').css({color:'red',float:'left','margin-top':'-14px'});                                
                                repair('#uname');                                
                               }
                               
        if(false===this.position) {$("#pos").css({border:"1px solid red",color:"red"});                    
                                   $('#pos-error').text('*Position Required').css({color:'red',float:'left','margin-top':'-14px'});                                
                                   repair('#pos');                                    
                                   }
                                   
        if(false===this.pass) {$("#pass").css({border:"1px solid red",color:"red"});                                      
                                $('#pass-error').text('*Password must be Insert').css({color:'red',float:'left','margin-top':'-14px'});                                
                                  repair('#pass');                                       
                               }
                                      
        if(false===this.dept) {$("#dept").css({border:"1px solid red",color:"red"});
                               $('#dept-error').text('*Department Required').css({color:'red',float:'left','margin-top':'-14px'});                                
                                 repair('#dept');                                       
                                }
                                      
        if(false===this.mail) {$("#mail").css({border:"1px solid red",color:"red"}); 
                               $('#mail-error').text('*Email is required').css({color:'red',float:'left','margin-top':'-14px'});                                
                                       repair('#mail');                                       
                                      }
                                      
        if(false===this.pno) {  $("#pno").css({border:"1px solid red",color:"red"});                                
                                $('#pno-error').text('*Phone Number must be Insert').css({color:'red',float:'left','margin-top':'-14px'});                                
                                repair("#pno");
                                  }
        }
    else{
     $('#user-error').empty();$('#pass-error').empty();$('#dept-error').empty();$("#pos-error").empty();$("#mail-error").empty();$('#pno').empty();
    $('#saveuser').submit();
        }
}