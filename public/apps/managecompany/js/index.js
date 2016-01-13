

$(document).ready(function(){
      dict= [];
             $.ajax({
                url:'managecompany/index/getcomname',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                  
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                 // alert(json_obj[i].member_login_name);
                dict.push(json_obj[i].company_id);
                }   
                }                        
              }); 
         
  document.getElementById('confirm').style.display = 'none';

 $('#com_name').on('click',function(){
        $(this).autocomplete({
            source: function( request, response ) {
               var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
             response( $.grep( dict, function( item ){                 
                 return matcher.test( item);
             }) );
            },
             minLength :1
        });
    });

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
