var pager = new Paging.Pager(),dict =[];   //for pagination

var AddCom = {
    Submit : function (){
        $.ajax({
           type : 'POST',
           url  : 'addnew',
           data : $('#apply_form').serialize(),
           success: function(d){

               cond = JSON.parse(d);
             
                 if(cond.result === 'error')
                { 
                $('#apply_form_sdate').css('border','black');$('#apply_form_edate').css('border','black');
                 $('#com_id_error').empty();$('#apply_form_desc_error').empty();$('#apply_form_sdate_error').empty();$("#apply_form_edate_error").empty();
                 for(var i in cond){
                   
                     switch(i){
                         case 'comid':$("#comid").css({border:"1px solid red",color:"red"});
                                         $('#com_id_error').text(cond[i]).css({color:'red'});
                                         repair('#comid');break;
                         case 'com_name':$("#com_name").css({border:"1px solid red",color:"red"});
                                         $('#com_name_error').text(cond[i]).css({color:'red'});
                                         repair('#com_name');break;
                        case 'com_sdate':$("#com_sdate").css({border:"1px solid red",color:"red"});
                                        $('#com_sdate_error').text(cond[i]).css({color:'red'});
                                        repair('#com_sdate');break;
                        case 'com_email':$("#com_email").css({border:"1px solid red",color:"red"});
                                        $('#com_email_error').text(cond[i]).css({color:'red'});
                                        repair('#com_email');break;
                        case 'com_phno':$("#com_phno").css({border:"1px solid red",color:"red"});
                                        $('#com_phno_error').text(cond[i]).css({color:'red'});
                                        repair('#com_phno');break;
                        case 'com_db':$("#com_db").css({border:"1px solid red",color:"red"});
                                        $('#com_db_error').text(cond[i]).css({color:'red'});
                                        repair('#com_db');break;
                        case 'com_dbun':$("#com_dbun").css({border:"1px solid red",color:"red"});
                                        $('#com_dbun_error').text(cond[i]).css({color:'red'});
                                        repair('#com_dbun');break;
                        case 'com_dbpsw':$("#com_dbpsw").css({border:"1px solid red",color:"red"});
                                        $('#com_dbpsw_error').text(cond[i]).css({color:'red'});
                                        repair('#com_dbpsw');break;
                        case 'com_host':$("#com_host").css({border:"1px solid red",color:"red"});
                                        $('#com_host_error').text(cond[i]).css({color:'red'});
                                        repair('#com_host');break;
                        case 'com_limit':$("#com_limit").css({border:"1px solid red",color:"red"});
                                        $('#com_limit_error').text(cond[i]).css({color:'red'});
                                        }
                                    }
                                }
                            }
                        });
                    }
                };
var ManageCompany = {
        init : function (reload){
            $('tfoot').append($('table.listtbl tbody').html());   //for csv 
            pager.perpage = 3;
            pager.para = $('table.listtbl tbody > tr');
            pager.showPage(1);
            $('tbody').show();
            if(reload){
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
    
    $('#add_com').on('click',function(e){
      AddCom.Submit();
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

