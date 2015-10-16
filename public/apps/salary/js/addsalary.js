var AddSalary = {
    Submit : function (){
        //alert($('#add_salary').serialize());
        $.ajax({
           type : 'POST',
           url  : baseUri+'salary/salarymaster/savesalary',
           data : $('#add_salary').serialize(),
           success: function(d){ 
               
               cond = JSON.parse(d);
              
                if(cond.result === 'error')
                { 
                 $('#add_salary_bsalary').css('border','black');$('#add_salary_ssc').css('border','black');
                 $('#add_salary_uname_error').empty();$('#add_salary_bsalary_error').empty();
                 $('#add_salary_ssc_error').empty();
                 
                 for(var i in cond){
                    //alert(i);
                     switch(i){
                         
                         case 'uname':$("#add_salary_uname").css({border:"1px solid red",color:"red"});
                                         $('#add_salary_uname_error').text(cond[i]).css({color:'red'});
                                         repair('#add_salary_uname');break;
                                                               
                         case 'bsalary'   :$('#add_salary_bsalary_error').text(cond[i]).css({color:'red'}); 
                                         break; 
                                     
                         case 'checkall'    : $('#add_salary_ssc_error').text(cond[i]).css({color:'red'});
                         
                                                    repair('#add_salary_checkall');break;            
                     }
                 }
                
            }
                else{
                    if(cond.success) { 
                        alert(cond.success);
                        location.reload();
                    }
                    else if(cond.error){
                        $('#add_salary_uname_error').empty();$('#add_salary_bsalary_error').empty();$("#add_salary_ssc_error").empty();
                       // alert(cond.error);
                        
                        $('#add_salary_bsalary').css({border:'1px solid red'});repair('#add_salary_bsalary');
                        $('#add_salary_check').css({border:'1px solid red'}); repair('#add_salary_checkall');
                    }
                    
                    
                   
                }
                
           }
        });
    }
};


 $(document).ready(function(){
   
    $('#addsalary').on('click',function(){
        //alert("aaa");
       AddSalary.Submit();
    });
   });