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
    },
    
     salnameautolist: function (){                       
        //var name = document.getElementById('namelist').value;
            //alert("aaa");
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
         var dict = [];
       $.ajax({
                url:'salaryusername',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                   // alert(json_obj[i].full_name);
                dict.push(json_obj[i].full_name);
                }
                  //var dict = ["Test User02","Adminstrator"];
                loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                       //alert(dict);
                        $('.salusername').autocomplete({
              source: dict
            });
       // ... do whatever you need to do with icon here
   } 
       }
};


 $(document).ready(function(){
   
    $('#addsalary').on('click',function(){
        //alert("aaa");
       AddSalary.Submit();
    });
    $(".salusername").click(function(){
		AddSalary.salnameautolist();
               
	});
   });