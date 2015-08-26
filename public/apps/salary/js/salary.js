/**
 * @author David
 * @desc   Salary Edit Search Print
 * @version 24/8/2015 David
 */
var pager = new Paging.Pager();

var Salary = {
    isOvl: false,
    init : function () {
       $("tfoot").html($('tbody').html());  //for csv
       //paging function
       pager.perpage =3;            
       pager.para = $('tbody > tr');
       pager.showPage(1); 
    },
    Search : function () {
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
                        +'<td colspan="9" style="text-align:center;"><b>Total salary for all user</b></td>'
                        +'<td><b>#####</b></td>'
                        +'<td></td>'
                        +'</tr>'
            $("tbody").append(html);
            //paginatior function
          this.init();
        },
        error: function (d) {
            alert('error');
        }
        });
    },
    AddSalary : function () {
    this.uname = $("#uname").val()==="" ? false:true;
    this.position = $("#position").val()==="" ? false:true;
    this.basicsalary = $("#bsalary").val()==="" ? false:true;
    this.checkbox = $('input[name="check_list[]"]:checked').length < 1 ? false:true ;
    this.transfer_fee = $("#travelfee").val()===""? false:true;
    this.overtime = $("#overtime").val()===""? false:true;
    
    $("#user-error").empty(),$("#position-error").empty(),$("#bsalary-error").empty(),$("#SSC-error").empty(),$("#travelfee-error").empty(),$("#overtime-error").empty();
    
    if(false===this.uname || false===this.position || false===this.basicsalary || false===this.checkbox || false === this.transfer_fee || false === this.overtime){
        
        if(false===this.uname) {$("#uname").css({border:"1px solid red",color:"red"});
                                $("#user-error").prepend("<span style='color:red;'>*Name must be Select</span>");
                                repair('#uname');                                
                               }
                               
        if(false===this.position) {$("#position").css({border:"1px solid red",color:"red"});
                                    $("#position-error").prepend("<span style='color:red;'>*Position must be Select</span>");
                                    repair('#position');                                    
                                   }
                                   
        if(false===this.basicsalary) {$("#bsalary").css({border:"1px solid red",color:"red"});
                                       $("#bsalary-error").prepend("<span style='color:red;'>*Basic Salary must be Insert</span>");
                                       repair('#bsalary');                                       
                                      }
                                      
        if(false===this.transfer_fee) {$("#travelfee").css({border:"1px solid red",color:"red"});
                                       $("#travelfee-error").prepend("<span style='color:red;'>*Travel Fee must be Insert</span>");
                                       repair('#travelfee');                                       
                                      }
                                      
        if(false===this.overtime) {$("#overtime").css({border:"1px solid red",color:"red"});
                                       $("#overtime-error").prepend("<span style='color:red;'>*Overtime Fee must be Insert</span>");
                                       repair('#overtime');                                       
                                      }
                                      
        if(false===this.checkbox) {    $("#SSC-error").prepend("<span style='color:red;'>*At Least one must be checked</span>");                                       
                                  }
        }
    else{
        $.ajax({
           type : "POST" ,
           url  : baseUri +"salary/salarymaster/savesalary",
           data : $('#adding_salary_form').serialize(),
           success : function(d){
               window.history.pushState("","","salarylist");
               $('body').html(d);
           }
        });
    }
   }
};
  Salary.Edit = {
        init :function (d) {
        $.ajax({
           url:"editsalary?id="+d,
           type: "GET",
           success:function(res){
               var result = $.parseJSON(res);               
               var data ='<form id="edit_salary"><table>';               
                   data += '<tr><td>User Name :</td>'
                        +'<td><input type="text" value='+result[0]['member_login_name']+ ' name="uname" disabled></td><td style="width:55px;height:40px;"></td>'
                        +'<td>Basic Salary :</td>'
                        +'<td><input type="text" value='+result[0]['basic_salary']+ ' name="basesalary" id="baseerr"></td></tr>'
                        +'<tr><td>Travel Fee :</td>'
                        +'<td><input type="text" value='+result[0]['travel_fee']+ ' name="travelfee" id="travelerr"></td><td style="width:55px;height:40px;"></td>'
                        +'<td>Over Time :</td>'
                        +'<td id="overmsg"><input style="width:50px;" type="text" value="'+result[0]['over_time']+'" name="overtime" id="overerr">%</td></tr>'
                        +'<tr><td>SSC Emp :</td>'
                        +'<td id="empmsg"><input style="width:50px;" type="text" value='+result[0]['ssc_emp']+' name="ssc_emp" id="emperr">%</td><td style="width:55px;height:40px;"></td>'
                        +'<td>SSC Comp :</td>'
                        +'<td id="compmsg"><input style="width:50px;" type="text" value='+result[0]['ssc_comp']+ ' name="ssc_comp" id="comperr">%</td></tr>'
                        +'<tr><td></td><td><input type="hidden" value='+result[0]['id']+ ' name="id"></td><td style="width:55px;height:40px;"></td></tr>';               
               data +='<tr><td></td><td colspan="3"><a href="#" class="button" id="edit_salary_edit">Edit</a><a href="#" class="button" id="edit_delete">Delete</a><a href="#" class="button" id="edit_close">Cancel</a></td></tr>';
               data +='</table></form>';
               Salary.Edit.Dia(data);
           }
        });    
    },
    Dia: function (d) {
        if (!this.isOvl) {
            this.isOvl = true;
        }

        $ovl = $('#edit_salary_dia');
        $ovl.dialog({
            autoOpen: false,
            height: 300,
            async: false,
            width: 800,
            modal: true,
            title: "Salary Edit"
        });
        $ovl.html(d);
        $ovl.dialog("open");
        $('#edit_salary_edit').click(function () {
            Salary.Edit.BtnEdit($ovl);
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
    
    Salary.init();
   
    $('#search_salary').click(function () {
        Salary.Search();
    });
    
    $("tbody").on('click',('.displaypopup'),function () {
        var id = $(this).attr('id');
        Salary.Edit.init(id);
    });
    //print function
    $(".print").click(function () {
        window.print();
    });
    
    $("#adding_salary_submit").click(function(){
       Salary.AddSalary();
    });
});


