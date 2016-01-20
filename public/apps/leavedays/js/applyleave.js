/** 
 * @type json array {}
 * @desc Apply Leave Form validation
 * @author David JP <david.gnext@gmail.com>
 */
var dict=[];
var ApplyForm = {
    init : function (){
         $.ajax({
                url:'autolist',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
               //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                   // alert(json_obj[i].full_name);
                        dict.push(json_obj[i].member_login_name);
                        }              
                }
                        
               }); 
    },
    Submit : function (){
        $.ajax({
           type : 'POST',
           url  : 'checkapply',
           data : $('#apply_form').serialize(),
           success: function(d){
               cond = JSON.parse(d);
               
                 if(cond.result === 'error')
                { 
                 $('#apply_form_sdate').css('border','black');$('#apply_form_edate').css('border','black');
                 $('#apply_form_name_error').empty();$('#apply_form_desc_error').empty();$('#apply_form_sdate_error').empty();$("#apply_form_edate_error").empty();
                 for(var i in cond){
                     switch(i){
                         case 'username':$("#apply_form_name").css({border:"1px solid red",color:"red"});
                                         $('#apply_form_username_error').text(cond[i]).css({color:'red'});
                                         repair('#apply_form_name');break;
                         case 'description':$("#apply_form_desc").css({border:"1px solid red",color:"red"});                    
                                         $('#apply_form_desc_error').text(cond[i]).css({color:'red'});
                                         repair('#apply_form_desc');break;
                         case 'sdate'   : $("#apply_form_sdate").css({border:"1px solid red",color:"red"});
                                         $('#apply_form_sdate_error').text(cond[i]).css({color:'red'});
                                         repair('#apply_form_sdate');break;
                         case 'edate'    :$("#apply_form_edate").css({border:"1px solid red",color:"red"});
                                         $('#apply_form_edate_error').text(cond[i]).css({color:'red'});
                                         repair('#apply_form_edate');break;
                     }
                 }
                }
                else{
                    if(cond.success) { 
                        alert(cond.success);
                        location.reload();
                    }
                    else if(cond.error){
                        $('#apply_form_name_error').empty();$('#apply_form_desc_error').empty();$('#apply_form_sdate_error').empty();$("#apply_form_edate_error").empty();
                        alert(cond.error);
                        $('#apply_form_sdate').css({border:'1px solid red'});repair('#apply_form_sdate');
                        $('#apply_form_edate').css({border:'1px solid red'}); repair('#apply_form_edate');
                    }
                }
           }
        });
    },  
       getmemid: function (name){                       
         var dict = [];
       $.ajax({
                url:'getapplymemberid?username='+name,
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                    
                dict.push(json_obj[i].member_id);
                }
                  //var dict = ["Test User02","Adminstrator"];
                 //alert(dict);
                 loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {                      
                        $('#formemberid').val(dict);
                     }
                     
       }
};
$(document).ready(function(){
    
   ApplyForm.init();
       $('.datetimepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datetimepicker').datetimepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            showTimezone :false,
                            maskInput : true,                                                                                                         
                           timeFormat: "HH:mm:ss"}).focus();                             
                     }); 
    $('#apply_form_submit').on('click',function(e){
      e.preventDefault();
      ApplyForm.Submit();
   });
   $('#apply_form_name').on('click',function(){     
//                $(this).autocomplete({
//                        source: function( request, response ) {               
//                                var results = $.ui.autocomplete.filter(dict, request.term);
//                                   response(results.slice(0, 10));  
//                        }
//                });
 $(this).autocomplete({
            source: function( request, response ) {                                       
               var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" ); 
               var result = $.grep( dict, function( item ){                 
                          return matcher.test( item);
                         });
                   response(result.slice(0, 10));
            },
             minLength :1
        });
    }); 
    $("#apply_form_sdate").on('blur',function(){
       var name = document.getElementById('apply_form_name').value;      
		ApplyForm.getmemid(name);               
	});
});

