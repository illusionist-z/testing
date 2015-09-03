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
          //data:$("#saveuser").serialize(),
            data :new FormData($("#saveuser")[0]),
            //async: false,
            //cache: false,
            processData: false,
            contentType: false,
            success: function(d){
               
                cond = JSON.parse(d);
                
                if(cond.result === 'error')
                {
                   
                 $('#user-error').empty();$('#pass-error').empty();$('#dept-error').empty();$("#pos-error").empty();$("#mail-error").empty();$('#pno').empty();   
                 for(var i in cond){
                     switch(i){
                         case 'username':$("#uname").css({border:"1px solid red",color:"red"});
                                         $('#user-error').text(cond[i]).css({color:'red',float:'left','margin-top':'-14px'});                                
                                         repair('#uname');break;
                         case 'position':$("#pos").css({border:"1px solid red",color:"red"});                    
                                         $('#pos-error').text(cond[i]).css({color:'red',float:'left','margin-top':'-14px'});                                
                                         repair('#pos');break;
                         case 'password':$("#pass").css({border:"1px solid red",color:"red"});                                      
                                         $('#pass-error').text(cond[i]).css({color:'red',float:'left','margin-top':'-14px'});                                
                                         repair('#pass');break;            
                         case 'dept'    :$("#dept").css({border:"1px solid red",color:"red"});
                                         $('#dept-error').text(cond[i]).css({color:'red',float:'left','margin-top':'-14px'});                                
                                         repair('#dept');break;            
                         case 'email'   :$("#mail").css({border:"1px solid red",color:"red"}); 
                                         $('#mail-error').text(cond[i]).css({color:'red',float:'left','margin-top':'-14px'});                                
                                         repair('#mail');break;            
                         case 'phno'    :$("#pno").css({border:"1px solid red",color:"red"});                                
                                         $('#pno-error').text(cond[i]).css({color:'red',float:'left','margin-top':'-14px'});                                
                                         repair("#pno");break;                                                
                     }
                 }
                } 
                else
                {
                    //$('body').load('dashboard');
                    alert("User Added Successfully");
                }    
                
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
