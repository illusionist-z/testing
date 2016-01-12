

$(document).ready(function(){
  document.getElementById('confirm').style.display = 'none';

 $('.show_pass').on('click',function(){
       document.getElementById('confirm').style.display = '';
    });
    
 $('.continue').on('click',function(){
        userpass= document.getElementById('userpass').value ;
          document.getElementById('confirm').style.display = 'none';
                $.ajax({
            type: 'GET',
            url: baseUri + 'managecompany/index/confirm?pass=' + userpass,
            success: function (d) {
               
                cond = JSON.parse(d); 

                if(cond=='success'){
                    pass= document.getElementById('dbpass').value ;
                      $('#dbpass').replaceWith('<input style="margin-top:10px ; width:50%" type="text" name="com[dbpsw]" class=" col-sm-10" value="'+pass+'" id="dbpass" placeholder="Write Database Password">');
                }
                else{
                    alert("Your Password is incorrect");
                }
            }
        });
        
     
     

    });
    

     
});

