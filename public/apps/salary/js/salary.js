/**
 * 
 * @author David
 * @desc   Salary Edit Dial Box
 */
var Salary = {
    isOvl:false,
    Edit : function (d){
        $.ajax({
           url:"editsalary?id="+d,
           type: "GET",
           success:function(res){
               var result = $.parseJSON(res);
               var data ='<form id="edit_salary"><table>';               
                   data += '<tr><td>User Name :</td><td><input type="text" value='+result[0]['member_login_name']+ ' name="uname" disabled></td>'
                        +'<td>Basic Salary :</td><td><input type="text" value='+result[0]['basic_salary']+ ' name="basesalary"></td></tr>'
                        +'<tr><td>Travel Fee :</td><td><input type="text" value='+result[0]['travel_fee']+ ' name="travelfee"></td>'
                        +'<td>Over Time :</td><td><input type="text" value='+result[0]['over_time']+'% name="overtime"></td></tr>'
                        +'<tr><td>SSC Emp :</td><td><input type="text" value='+result[0]['ssc_emp']+'% name="ssc_emp"></td>'
                        +'<td>SSC Comp :</td><td><input type="text" value='+result[0]['ssc_comp']+ '% name="ssc_comp"></td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['id']+ ' name="id"></td><td></td></td></tr>';               
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="edit_salary_edit">Edit</a><a href="#" class="button" id="edit_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td></tr>';
               data +='</table></form>';
               Salary.Dia(data);
           }
        });
        },
    Dia : function (d){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#edit_salary_dia');
        $ovl.dialog({
            autoOpen: false,
            height: 250,
            async:false,            
            width: 800,
            modal: true,
            title:"Salary Edit"
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
        $('#edit_salary_edit').click(function(){
            Salary.BtnEdit($ovl);
        });            
        $('#edit_close').click(function(){
           $ovl.dialog("close");
        });       
    },
    BtnEdit : function(d){
        var form=$('#edit_salary');
        $.ajax({
            type:'POST',
            data: form.serialize(),
            url : "btnedit",
            success:function(){
                d.dialog("close");
            }
        }).done(function(){
            $('body').load('salarylist');
        });
    }
};
$(document).ready(function () {

   $('#search_salary').click(function(){     
       var $form = $('#search_frm').serialize();
        alert("aaaa");
        window.location.href = baseUri + 'salary/calculate';
    });
   $(".displaypopup").click(function () {
        var id = $(this).attr('id');
        Salary.Edit(id);
    });    
        window.location.href = baseUri + 'salary/search?'+$form;
    })
});
