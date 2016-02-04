// selects all the divs of class='sample',hides them, finds the first, and shows it
$('div.sample').hide().first().show();
var i=0;
// binds a click event-handler to a elements whose class='display'
$('a.display').on('click', function(e) {
    // prevents the default action of the link
    e.preventDefault();
    

    // assigns the currently visible div.sample element to a variable
    var that = $('div.sample:visible'),
        // assigns the text of the clicked-link to a variable for comparison purposes
        t = $(this).text();
        //alert(that.next('div.sample').length);
    // checks if it was the 'next' link, and ensures there's a div to show after the currently-shown one
    if (t == 'NEXT' && that.next('div.sample').length > 0) {
        // hides all the div.sample elements
        i++;
        $('div.sample').hide();
        
        // shows the 'next'
        
        that.next('div.sample').show();
    }
    
    // exactly the same as above, but checking that it's the 'prev' link
    // and that there's a div 'before' the currently-shown element.
    else if (t == 'PREV' && that.prev('div.sample').length > 0) {
    i--;
       
        $('div.sample').hide();
        that.hide().prev('div.sample').show();
    }
});
var Resign = {
    
      Add : function (id){
        //alert(id);
        $.ajax({
            
           url:"",
           type: "POST",
           success:function(){          
               var data ='<form id="Resign_Date"><table>';               
                   data += '<tr><td></td></tr>'
                        +'<tr><br><td><small>Resign Date:</small> </td><td style="font-size:10px;"><input type="text" style="margin-top:10px;" class="datepicker form-control" name="resign_date" id="resign_date" placeholder="Resign Date" ></td></tr>';
                        +'<tr><td></td></tr>';             
                   data +='<tr><td></td><td colspan="3"><br><a href="#" class="button" id="Add_Resign_Date">Save</a><a href="#" class="button" id="cancel">Cancel</a></td></tr>';
                   data+='<input type="hidden" name="member_id" id="resign_date" value="'+id+ '"td></tr>';

                   data +='</table></form>';
                //$( ".datepicker" ).datepicker();
               Resign.Diaadd(data);
           }
        });
        },
        Diaadd : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#resign');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async:false,            
            width: 'auto',
            modal: true,
            title:"Add Resign Date"
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
             
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $('.datepicker').on('click',function(e){
            e.preventDefault();                                                    
            $(this).removeClass('datepicker').datepicker().focus();                               
        });   
        $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});         
        $('#Add_Resign_Date').click(function(){
            Resign.AddNew($ovl);
        });
         $('#cancel').click(function(){
           $ovl.dialog("close");
          // location.reload();

        });
        
        
        },
        AddNew : function(d){
        var form=$('#Resign_Date');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : baseUri+"salary/index/addresigndate",
            success:function(){
                
                d.dialog("close");
                

            }
        }).done(function(){
           //location.reload();
        });
    }
    
};

$(document).ready(function () {

    // ユーザーのクリックした時の動作。

   
    
     $('.btn_resign').click(function () {
        // alert("aa");
       var id= document.getElementById("member_id").value;
        Resign.Add(id);
    });
    //Enable the textbox for salary detail
    $('.btnEditInfo').click(function () {
        //document.getElementById('txtname').disabled=false;
//        document.getElementById('btn_savedetail').disabled=false;
//        document.getElementById('txtbsalary').disabled=false;
//        document.getElementById('txtbsalary').disabled=false;
//        document.getElementById('txtovertimerate').disabled=false;
//        document.getElementById('txtallowance').disabled=false;
var cells = document.getElementsByClassName("txtenable"); 
for (var i = 0; i < cells.length; i++) { 
    cells[i].disabled = false;
}
    });

    $("#btn_savedetail").click(function () {
       var member_id_arr=document.getElementsByClassName("member_id");//document.getElementById('member_id').value; 
       var b_salary_arr=document.getElementsByClassName('txtbsalary');
       var overtime_rate_arr=document.getElementsByClassName('txtovertimerate');
       var overtimehour=document.getElementsByClassName('txtovertimehour');
       var specific_deduce_arr=document.getElementsByClassName('txtallowance');
       var absent_amount=document.getElementsByClassName('txtabsent');
       var year=document.getElementById('year').value;
       var month=document.getElementById('month').value;
       b_salary=b_salary_arr[i].value;
       member_id=member_id_arr[i].value;
       overtime_rate=overtime_rate_arr[i].value;
       overtime_hr=overtimehour[i].value;
       specific_duty_allowance=specific_deduce_arr[i].value; 
       absent=absent_amount[i].value;
       
       if(specific_duty_allowance=="")
       {
        specific_duty_allowance=0;
        }
        alert(specific_duty_allowance);
         //window.location.href = baseUri + 'salary/salarymaster/editsalarydetail/'+$b_salary+'/'+$overtime_rate+'/0/'+$member_id;  
       $.ajax({
            type:'get',
            //url : baseUri + 'salary/salarymaster/editsalarydetail?bsalary='+$b_salary+'& overtime='+$overtime_rate+'& specific_dedce=0 & member_id='+$member_id,
            url : baseUri + 'salary/salarymaster/editsalarydetail/'+b_salary+'/'
                    +overtime_rate+'/'+specific_duty_allowance+'/'+member_id+'/'
                    +absent+'/'+year+'/'+month+'/'+overtime_hr,
            success:function(){
             alert("Data has been updated");
              window.location.reload();
            }
        })
//        
//       else{
//       
//       window.location.href = baseUri + 'salary/salarymaster/editsalarydetail/'+b_salary+'/'+overtime_rate+'/'+specific_duty_allowance+'/'+member_id+'/'+year+'/'+'/'+month;
//        }
    });
   
});
