/**
 * 
 * @author David 
 * @since 25/8/2015
 * @desc adduser form validation
 */
  
   UserAdd = {
     Submit : function (){
      
        $.ajax({
            type:'POST',
            url :baseUri+'manageuser/coremember/saveuser',
          //data:$("#saveuser").serialize(),
          data :new FormData($("#saveuser")[0]),
            //async: false,
            //cache: false,
             
            processData: false,
            contentType: false,
            success: function(d){
                this.cond = JSON.parse(d);
                
                if(this.cond.result === 'error')
                {
                 for(var i in this.cond){
                     $('#saveuser input').addClass('adduser-table');//for placeholder text color
                     switch(i){
                         case 'uname':$("#uname").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);
                                         repair('#uname');break;
                         case 'work_sdate':$("#work_sdate").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);
                                         repair('#work_sdate');break;
                         case 'position':$("#pos").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);                                         
                                         repair('#pos');break;
                         case 'password':$("#pass").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);                                         
                                         repair('#pass');break;
                         case 'confirm':$("#confirmpass").val("").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);                                         
                                         repair('#confirmpass');break;
                         case 'dept'    :$("#dept").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);                                         
                                         repair('#dept');break;            
                         case 'email'   :$("#mail").val("").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);                                          
                                         repair('#mail');break;            
                         case 'phno'    :$("#pno").val("").css({border:"1px solid red",color:"red"}).attr("placeholder",this.cond[i]);                                         
                                         repair("#pno");break;                                                
                     }
                 }
                }
                else if(this.cond.result === 'existId'){
                    for(var i in this.cond){                     
                     switch(i){
                                case 'uname':$("#uname").val("");
                                        $('#existId').text(this.cond[i]).css({color:"red"});
                                         repair('#uname');break;
                                 }
                             }
                }
                else
                {
                    alert("User Added Successfully");
                    location.replace("index");
                }    
                
            }
        });
     }    
};
