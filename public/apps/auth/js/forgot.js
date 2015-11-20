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
                       window.location.href = baseUri + 'auth/index/resetpassword?email='+email;
                    }else{
                      //  alert("User with that email doesn't exist!");
                      $('#emailerror').hide();
                       $('#noemailerror').show();
                       $('#emailaddress').val('');
//                        window.location.href = baseUri + 'auth/index/forgotpassword';
                    }
                        }
                       
                    });
                    
   
       }
};


 $(document).ready(function(){
   
    
    
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
   });
