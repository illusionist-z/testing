/** 
 * @type json array {}
 * @desc Apply Leave Form validation
 * @author David JP <david.gnext@gmail.com>
 */
var ApplyForm = {
    Submit : function (){
        $.ajax({
           type : 'POST',
           url  : 'applyleave',
           data : $('#apply_form').serialize(),
           success: function(d){
                //alert($('#apply_form').serialize());
               cond = JSON.parse(d);
                 if(cond.result === 'error')
                { 
                 $('#apply_form_sdate').css('border','black');$('#apply_form_edate').css('border','black');
                 $('#apply_form_name_error').empty();$('#apply_form_desc_error').empty();$('#apply_form_sdate_error').empty();$("#apply_form_edate_error").empty();
                 for(var i in cond){
                     switch(i){
                         case 'username':$("#apply_form_name").css({border:"1px solid red",color:"red"});
                                         $('#apply_form_name_error').text(cond[i]).css({color:'red'});
                                         repair('#apply_form_name');break;
                         case 'description':$("#apply_form_desc").css({border:"1px solid red",color:"red"});                    
                                         $('#apply_form_desc_error').text(cond[i]).css({color:'red'});
                                         repair('#apply_form_desc');break;
                         case 'sdate'   :$('#apply_form_sdate_error').text(cond[i]).css('color','red'); 
                                         break;            
                         case 'edate'    :$("#apply_form_edate").css({border:"none",color:"red"});
                                         $('#apply_form_edate_error').text(cond[i]).css({color:'red'});
                                        break;            
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
    }
};
$(document).ready(function(){
   
    $('#apply_form_submit').on('click',function(){
      ApplyForm.Submit();
   });
});

