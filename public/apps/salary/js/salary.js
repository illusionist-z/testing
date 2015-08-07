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
                   data += '<tr><td>User Name :</td><td><input type="text" value='+result[0]['member_id']+ ' name="id"></td>'
                        +'<td>Basic Salary :</td><td><input type="text" value='+result[0]['basic_salary']+ ' name="id"></td></tr>'
                        +'<tr><td>Travel Fee :</td><td><input type="text" value='+result[0]['travel_fee']+ ' name="id"></td>'
                        +'<td>Over Time :</td><td><input type="text" value='+result[0]['over_time']+'% name="id"></td></tr>'
                        +'<tr><td>SSC Emp :</td><td><input type="text" value='+result[0]['ssc_emp']+'% name="id"></td>'
                        +'<td>SSC Comp :</td><td><input type="text" value='+result[0]['ssc_comp']+ '% name="id"></td></tr>'
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
        $('#edit_close').click(function(){
           $ovl.dialog("close");
        });
       // $(".ui-dialog,.ui-dialog,.ui-widget, .ui-widget-content, .foo, .ui-draggable, .ui-resizable ").css("background","#fff0ac");
    }
};
$(document).ready(function () {

   $('#calculate').click(function(){        
        alert("aaaa");
        window.location.href = baseUri + 'salary/calculate';
    });
   $(".displaypopup").click(function () {
        var id = $(this).attr('id');
        Salary.Edit(id);
    });    
});
