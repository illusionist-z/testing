/**
 * @author David JP<david.gnext@gmail.com>
 * @desc   Salary Edit Dial Box
 */
var Salary = {
    isOvl: false,
    Edit: function (d) {
        $.ajax({
           url:"editsalary?id="+d,
           type: "GET",
           success:function(res){
               var result = $.parseJSON(res);               
               var data ='<form id="edit_salary" width="650px" height="500px"><table width="400px" height="300px" align="center" style="font-size:13px;" >';               
                   data += '<br>'
                        +'<tr><td style="width:100px;">User Name </td>'
                        +'<td><input style="margin-top:10px;" type="text" value="'+result[0]['member_login_name']+ '" name="uname" disabled></td></tr>'
                        +'<tr><td>Basic Salary </td>'
                        +'<td><input style="margin-top:10px;" type="text" value='+result[0]['basic_salary']+ ' name="basesalary" id="baseerr"></td></tr>'
                        +'<tr><td>Travel Fee </td>'
                        +'<td><input style="margin-top:10px;" type="text" value='+result[0]['travel_fee']+ ' name="travelfee" id="travelerr"></td></tr>'
                        +'<tr><td>Over Time </td>'
                        +'<td id="overmsg"><input style="width:50px;margin-top:10px;" type="text" value="'+result[0]['over_time']+'" name="overtime" id="overerr"> %</td></tr>'
                        +'<tr><td>SSC Emp </td>'
                        +'<td id="empmsg"><input style="width:50px;margin-top:10px;" type="text" value='+result[0]['ssc_emp']+' name="ssc_emp" id="emperr"> %</td></tr>'
                        +'<tr><td>SSC Comp </td>'
                        +'<td id="compmsg"><input style="width:50px;margin-top:10px;" type="text" value='+result[0]['ssc_comp']+ ' name="ssc_comp" id="comperr"> %</td></tr>'
                        +'<tr><td><input type="hidden" value='+result[0]['id']+ ' name="id"></td><td style="width:55px;height:40px;"></td></tr>';               
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="edit_salary_edit" >Edit</a><a href="#" class="button" id="edit_delete" >Delete</a><a href="#" class="button" id="edit_close" >Cancel</a></td></tr>';
               data +='</table></form>';
               Salary.Dia(data);
           }
        });
    },
    Dia: function (d) {
        if (!this.isOvl) {
            this.isOvl = true;
        }

        $ovl = $('#edit_salary_dia');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 420,
            resizable:false,
            async: false,
            width: 450,
            modal: true,
            title: "Salary Edit",
            /*show:{
                effect:"explode",//effect:"blind",
		duration:200
	    },
            hide:{
		effect:"explode",
		duration:200
	    }*/
        });
        $ovl.html(d);
        $ovl.dialog("open");
        $('#edit_salary_edit').click(function () {
            Salary.BtnEdit($ovl);
        });
        $('#edit_close').click(function () {
            $ovl.dialog("close");
        });
    },
    BtnEdit : function(val){
        var form=$('#edit_salary');
        $.ajax({
            type: 'POST',
            data: form.serialize(),
            dataType:'json',
            url : "btnedit",
            success:function(d){                
                //if true success funcion then reload page
                if(true === d.valid)                      
                {
                    val.dialog("close");
                    $('body').load("salarylist");
                }
                //if fail , show error data
                else{
                    $('#empmsg > span').empty();$("#overmsg > span").empty();$('#compmsg > span').empty();
                    if(false === d.baseerr){
                    $("#baseerr").val("Base Salary Required").css({border:"1px solid red",
                                                                   color:"red"});
                    repair('#baseerr');
                      }
                     if(false === d.travelerr ){
                    $("#travelerr").val("Base Salary Required").css({border:"1px solid red",
                                                                     color:"red"});
                    repair('#travelerr');
                      }
                    if(false === d.overtimerr){
                    $("#overerr").css({border:"1px solid red",
                                      color:"red"});
                    $("#overmsg").append("<span style='color:red;font-size:9px;'>*Overtime Percent Number Required</span>");
                    repair('#overerr');
                    }  
                    if(false === d.sscemp ){
                    $("#emperr").css({border:"1px solid red",
                                      color:"red"});
                    $("#empmsg").append("<span style='color:red;font-size:9px;'>*SSC Emp Percent Number Required</span>");
                    repair('#emperr');
                    }  
                    if(false === d.ssccomp){
                    $("#comperr").css({border:"1px solid red",
                                      color:"red"});
                    $("#compmsg").append("<span style='color:red;font-size:9px;'>*SSC Comp Percent Number Required</span>");                                  
                    repair('#comperr');
                    }  
                }
            }
        });
    }
};
$(document).ready(function () {

    $('#search_salary').click(function () {
        salarysearch();

    });
    $(".displaypopup").click(function () {
        var id = $(this).attr('id');
        Salary.Edit(id);
    });
    $(".print").click(function () {
        window.print();
    });
});
var salarysearch = function () {
    var $form = $('#search_frm').serialize();
    var year=document.getElementById('year').value;
    var month=document.getElementById('month').value;
    //window.location.href = baseUri + 'salary/search?'+$form;
    $.ajax({
        url: baseUri + 'salary/search?' + $form,
        type: 'GET',
        success: function (d) {
            var json_obj = $.parseJSON(d);//parse JSON            
            $('tbody').empty();
            for (var i in json_obj)
            {

                var output = "<tr>"
                        + "<td>" + json_obj[i].member_login_name + "</td>"
                        + "<td>" + json_obj[i].member_dept_name + "</td>"
                        + "<td>" + json_obj[i].basic_salary + "</td>"
                        + "<td>" + json_obj[i].overtime + "</td>"
                        + "<td>" + json_obj[i].travel_fee + "</td>"
                        + "<td>" + json_obj[i].absent_dedution + "</td>"
                        + "<td>" + json_obj[i].income_tax + "</td>"
                        + "<td>" + json_obj[i].ssc_comp + "</td>"
                        + "<td>" + json_obj[i].ssc_emp + "</td>"
                        + "<td>" + json_obj[i].total + "</td>"
                        + '<td><a href="payslip?member_id='+json_obj[i].member_id+' && month='+month+' && year='+year+'" class="button">Print</a></td>'
                        + "</tr>"
                        
                $("tbody").append(output);
            }
            var html='<tr style="background-color:#428bca; color:#ffffff;">'
                        +'<td colspan="10" style="text-align:center;"><b>Total salary for all user</b></td>'
                        +'<td><b>#####</b></td>'
                        +'<td></td>'
                        +'</tr>'
            $("tbody").append(html);
            //paginatior function
//            pager.perpage =3;            
//            pager.para = $('tbody > tr');
//            pager.showPage(1);   
            //pager.showNavi(1);
        },
        error: function (d) {
            alert('error');
        }
    });
}
