var pager = new Paging.Pager(),dict =[];   //for pagination

/*
 * show today list by return json array
 * @version 24/8/2015 David
 */
var ManageCompany = {
        init : function (reload){
            $('tfoot').append($('table.listtbl tbody').html());   //for csv 
            pager.perpage = 3;
            pager.para = $('table.listtbl tbody > tr');
            pager.showPage(1);
            $('tbody').show();
            if(reload){
               $.ajax({
                url:'managecompany/index/getcomname',
                     }
                 }
                }
                else{
                    alert("Add Successfully");
                    location.reload("managecompany/index")
                }
           }
        });
    }
};

$(document).ready(function(){
     $('#add_com').on('click',function(e){
      AddCom.Submit();
   });
    
      dict= [];
             $.ajax({
                url:baseUri+'managecompany/index/getcomname',
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
          }
        }
    };

$(document).ready(function(){              
    ManageCompany.init(1);
    
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

