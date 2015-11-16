// selects all the divs of class='sample',hides them, finds the first, and shows it
$('div.sample').hide().first().show();

// binds a click event-handler to a elements whose class='display'
$('a.display').on('click', function(e) {
    // prevents the default action of the link
    e.preventDefault();

    // assigns the currently visible div.sample element to a variable
    var that = $('div.sample:visible'),
        // assigns the text of the clicked-link to a variable for comparison purposes
        t = $(this).text();

    // checks if it was the 'next' link, and ensures there's a div to show after the currently-shown one
    if (t == 'NEXT' && that.next('div.sample').length > 0) {
        // hides all the div.sample elements
        $('div.sample').hide();

        // shows the 'next'
        that.next('div.sample').show()
    }
    // exactly the same as above, but checking that it's the 'prev' link
    // and that there's a div 'before' the currently-shown element.
    else if (t == 'PREV' && that.prev('div.sample').length > 0) {
        $('div.sample').hide();
        that.hide().prev('div.sample').show()
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
        $('#Add_Resign_Date').on('click',function(){
            Resign.AddNew($ovl);
        });
         $('#cancel').on('click',function(){
           $ovl.dialog("close");
          // location.reload();

        });
        
        
        },
         AddNew : function(d){
        var form=$('#Resign_Date');
       //alert(form.serialize());
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

   
    
     $('.btn_resign').on('click',function(){
        // alert("aa");
       var id= document.getElementById("member_id").value;
        Resign.Add(id);
    });
    //Enable the textbox for salary detail
    $('.btnEditInfo').on('click',function(){
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

    $("#btn_savedetail").on('click',function(){
        //alert("AAA");
//      $(".txtenable").each(function() {
//    //alert($(this).val());
//});

       var member_id=document.getElementById('member_id').value; 
       var b_salary=document.getElementById('txtbsalary').value;
       var overtime_rate=document.getElementById('txtovertimerate').value;
       var specific_deduce=document.getElementById('txtallowance').value;
       var year=document.getElementById('year').value;
       var month=document.getElementById('month').value;
       //alert(document.getElementById('txtbsalary').value);
//       $year=document.getElementById('year').value;
//       $month=document.getElementById('month').value;
//       
       if(specific_deduce=="")
       {
         //window.location.href = baseUri + 'salary/salarymaster/editsalarydetail/'+$b_salary+'/'+$overtime_rate+'/0/'+$member_id;  
       $.ajax({
            type:'get',
            //url : baseUri + 'salary/salarymaster/editsalarydetail?bsalary='+$b_salary+'& overtime='+$overtime_rate+'& specific_dedce=0 & member_id='+$member_id,
            url : baseUri + 'salary/salarymaster/editsalarydetail/'+b_salary+'/'+overtime_rate+'/0/'+member_id+'/'+year+'/'+'/'+month,
            success:function(){
//                alert("Data has been updated");
//                window.location.reload();
            }
        })
        }
       else{
       
       window.location.href = baseUri + 'salary/salarymaster/editsalarydetail/'+b_salary+'/'+overtime_rate+'/'+specific_deduce+'/'+member_id+'/'+year+'/'+'/'+month;
        }
    });
   
});
