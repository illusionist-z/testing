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
                 for(var i in cond){
                     $('input').addClass('adduser-table');//for placeholder text color
                     switch(i){
                         case 'username':$("#uname").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);
                                         repair('#uname');break;
                         case 'position':$("#pos").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);                                         
                                         repair('#pos');break;
                         case 'password':$("#pass").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);                                         
                                         repair('#pass');break;
                         case 'confirm':$("#confirmpass").val("").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);                                         
                                         repair('#confirmpass');break;
                         case 'dept'    :$("#dept").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);                                         
                                         repair('#dept');break;            
                         case 'email'   :$("#mail").val("").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);                                          
                                         repair('#mail');break;            
                         case 'phno'    :$("#pno").val("").css({border:"1px solid red",color:"red"}).attr("placeholder",cond[i]);                                         
                                         repair("#pno");break;                                                
                     }
                 }
                } 
                else
                {
                    alert("User Added Successfully");
                    location.replace("userlist");
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
