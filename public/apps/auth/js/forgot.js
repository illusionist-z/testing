var forgot  = {
    
     checkmail: function (email){ 
       $.ajax({
                url:'checkmail',
                method: 'GET',
                data:{email:email},
               // dataType: 'json',
                success: function(d) {                   
                    data= JSON.parse(d);
                    if(data==='success'){
                       // alert(data);
                            window.location.href = baseUri + 'auth/index/resetpassword?email='+email;
                    }else{
                      //  alert("User with that email doesn't exist!");
                      $('#emailerror').hide();
                       $('#noemailerror').show();
                       $('#emailaddress').val('');
                     //  window.location.href = baseUri + 'auth/index/forgotpassword';
                    }
                        }
                       
                    });
       },
       
       checkcode: function (code,email){ 
       $.ajax({
                url:'checkcode',
                method: 'GET',
                data:{code:code,email:email},
               // dataType: 'json',
                success: function(c) {
                   // alert(d);
                    data= JSON.parse(c);
                    if(data==='success'){
                       window.location.href = baseUri + 'auth/index/newpassword?email='+email;
                    }else{
                      //  alert("User with that email doesn't exist!");
                      $('#codeerror').hide();
                       $('#checkcodeerror').show();
                      //  window.location.href = baseUri + 'auth/index/forgotpassword';
                    }
                        }                       
                    });
       },
       // for change password
        changenewpass: function (fnp,email){ 
        //alert(fnp);
       $.ajax({
                url:'changepassword',
                method: 'GET',
                data:{fnp:fnp,email:email},
               // dataType: 'json',
                success: function(e) {
                    data= JSON.parse(e);
                     if(data =='success'){
                            window.location.href = baseUri + 'auth';
                     }else{
                       // alert("User with that email doesn't exist!");exit;
                      $('#codeerror').hide();
                       $('#checkcodeerror').show();         
                      
//                        window.location.href = baseUri + 'auth/index/forgotpassword';
                    }
                        }
                       
                    });
       }
};


 $(document).ready(function(){
     //for check box
     $("#show").click(function(){
       var show = document.getElementById('show');
       if(show.checked){
                        var fnp = document.getElementById('forgotnewpassword').value;
                        var fcp = document.getElementById('forgotcomfirmpassword').value;
                            document.getElementById('shownewpassword').value = fnp;
                            document.getElementById('showconfirmpassword').value = fcp;
            $('#showpassword').show();    
            $('#showconpassword').show();    
            $('#hidepassword').hide();
            $('#hideconpassword').hide();
       }else{
                    var snp = document.getElementById('shownewpassword').value;
                    var scp = document.getElementById('showconfirmpassword').value;
                        document.getElementById('forgotnewpassword').value = snp;
                        document.getElementById('forgotcomfirmpassword').value = scp;
                        
           $('#hidepassword').show();
            $('#hideconpassword').show();
            $('#showpassword').hide();  
            $('#showconpassword').hide();    
            
       }
    });
    $("#btngo").click(function(){
       var email = document.getElementById('emailaddress').value;
       if(email == ''){
           $('#emailerror').show();
           $('#noemailerror').hide();
          // document.getElementById('emailaddress').value='Enter Your Email Address';
       }else{
          forgot.checkmail(email);
       }
    });
    
    //for continue button of sendmail
            $("#btncontinue").click(function(){
                
                var email = document.getElementById('emailaddress').value;
               var code = document.getElementById('code').value;
               if(code == ''){
                   $('#codeerror').show();
               }
               else{
                    forgot.checkcode(code,email);
               }
            });
            
            //for btnemail of resetpassword
            $("#btnemail").click(function(){          
               var email=document.getElementById('emailaddress').value;
               window.location.href = baseUri + 'auth/index/sendmail?email='+email;
            });
            
        //for check new password of new password
            $("#btnnewpass").click(function(){
                var email = document.getElementById('emailaddress').value;
                var fnp = document.getElementById('forgotnewpassword').value;
                var fcp = document.getElementById('forgotcomfirmpassword').value;
               if(fnp == '' &&  fcp == '' ){
                    $('#newpasserror').hide();    
                    $('#passlong').hide(); 
                    $('#newpassempty').show();   
               }
               else{
                         if(fnp != fcp  ){
                                     $('#newpassempty').hide();   
                                     $('#passshort').hide(); 
                                    $('#newpasserror').show();                
                        }
                        else{
                                //alert(fnp.length);
                               if(fnp.length < 6 ){
                                    $('#passshort').show();   
                                    $('#newpassempty').hide();   
                                    $('#newpasserror').hide(); 
                               }else{
                                        if(fnp.length > 16 ){
                                            $('#passlong').show();   
                                            $('#passshort').hide();   
                                            $('#newpassempty').hide();   
                                            $('#newpasserror').hide(); 
                                        }
                                        else{ 
                                                 forgot.changenewpass(fnp,email);
                                        }
                               }
                           
                        }
               }
              
            });
   });
