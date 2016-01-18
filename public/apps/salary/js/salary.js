
/**
 * @author David JP<david.gnext@gmail.com>
 * @desc   Salary Edit Dial Box
 */
var pager = new Paging.Pager();   //for pagination
var Salary = {
    isOvl: false,
    init  : function() {
        $("tfoot").html($('tbody').html()); //for csv
        pager.perpage = 10;            
        pager.para = $('tbody > tr');
        pager.showPage(1);  
        $("tbody").show();
        },
     Edit: function (d) {
        $.ajax({
           url:"editsalary?id="+d,
           type: "GET",
          success:function(res){
              
               var result = $.parseJSON(res);
               
               var data ='<form id="edit_salary" width="650px" height="500px"><table width="550px" height="300px" >';               
                   data +='<tr><td></td><td><b>'+result.t['name']+'</b><input style="margin-top:10px;" type="hidden" value='+result.data[0]['member_id']+ ' name="member_id" id="member_id"></td>'
                        +'<td><input style="margin-top:10px;" type="text" value= " '+result.data[0]['member_login_name']+ ' " name="uname" disabled></td><td ></td></tr>'
                        +'<tr><td></td><td><b>'+result.t['b_salary']+' </b></td>'
                        +'<td><input style="margin-top:10px;" type="text" value='+result.data[0]['basic_salary']+ ' name="basesalary" id="baseerr"></td></tr>'
                        +'<tr><td></td><td><b>'+result.t['t_fee']+'per day</b></td>'
                        +'<td><input style="margin-top:10px;" type="text" value='+result.data[0]['travel_fee_perday']+ ' name="travelfee" id="travelerr"></td><td style="width:100px;height:40px;"></td></tr>'
                        +'<tr><td></td><td><b>'+result.t['t_fee']+'per month</b></td>'
                        +'<td><input style="margin-top:10px;" type="text" value='+result.data[0]['travel_fee_permonth']+ ' name="travelfee" id="travelerr"></td><td style="width:100px;height:40px;"></td></tr>'
                        +'<tr><td></td><td><b>'+result.t['ot']+'</b></td>'
                        +'<td id="overmsg"><input style="width:100px;margin-top:10px;" type="text" value="'+result.data[0]['over_time']+'" name="overtime" id="overerr"></td></tr>'
                        +'<tr><td></td><td>SSC Emp </td>'
                        +'<td id="empmsg"><input style="width:50px;margin-top:10px;" type="text" value='+result.data[0]['ssc_emp']+' name="ssc_emp" id="emperr"> %</td><td style="width:55px;height:40px;"></td></tr>'
                        +'<tr><td></td><td><b>SSC Comp </b></td>'
                        +'<td id="compmsg"><input style="width:50px;margin-top:10px;" type="text" value='+result.data[0]['ssc_comp']+ ' name="ssc_comp" id="comperr"> %</td></tr>';
                       
                data += '<tr><td></td><td> '+result.t['Decut Name']+' </td><td colspan="4" style="font-size:12px;">';
                for(var j in result.dedution){
                var duct = Salary.Check(result.dedution[j]['deduce_id'],result.permit_dedution);
               if(Salary.Check('children',result.permit_dedution)!='checked'){
                   result.no_of_children='No';
               };
                data +=' <input type="checkbox" name="check_list[]" value="'+result.dedution[j]["deduce_id"]+'" '+(duct!=='undefined'?duct:"") +'> ';
                 if(j==1){
                    data+='<input type="text" name="no_of_children" value='+result.no_of_children+' style="width:13%;margin-bottom:-1px">';
                }
                data+=result.dedution[j]["deduce_name"]+'<br>'
              }
                
                data +='<br></td></tr>';
               
                    data += '<tr><td></td><td> '+result.t['Allow Name']+' </td><td colspan="4" style="font-size:12px;">';
                for(var i in result.allowance){
                var cond=Salary.Check(result.allowance[i]['allowance_name'],result.permit_allowance);
                data +=' <input type="checkbox" name="check_allow[]" value="'+result.allowance[i]["allowance_id"]+'" '+ (cond!=='undefined'?cond:"") +'> '+ result.allowance[i]["allowance_name"] +'<br>';
                }
                //data +='<input type="hidden" value= " '+result.data[0]['salary_start_date']+ ' " name="work_sdate" id="work_sdate"></td></tr>';
                  data += '<tr><td></td><td>'+result.t['Starting Date']+'  </td><td><input style="margin-top:10px;" class="datepicker" type="text" value='+result.data[0]['salary_start_date']+' name="work_sdate" id="work_sdate" placeholder="choose start date"></td></tr>';
                data += '<tr><td></td><td><input type="hidden" value='+result.data[0]['id']+ ' name="id"></td><td style="width:55px;height:40px;"></td></tr>';
             
                data +='<tr><td></td><td></td><td colspan="3"><a href="#" class="button" id="edit_salary_edit" >'+result.t['edit_btn']+'</a><a href="#" class="button" id="edit_delete" >'+result.t['delete_btn']+'</a><a href="#" class="button" id="edit_close" >'+result.t['cancel_btn']+'</a></td></tr>';
                data +='</table></form>';
                Salary.Dia(data,result.t['title']);
                $('.datepicker').on('click',function(e){
                          e.preventDefault();                                                    
                         $(this).removeClass('datepicker').datepicker( { dateFormat:"yy-mm-dd",                                                                                           
                            }).focus();                               
                     }); 
           }
        });
    },
    Check: function(name,permit){
        var $check;
        for(var n in permit){
         var permit_name = permit[n]['allowance_name']||permit[n][0];
         switch(permit_name){
             case name:$check="checked";break;
             default  :break;
         }
        }
        return $check;
    },
    
    Dia: function (d,title) {
        if (!this.isOvl) {
            this.isOvl = true;
        }

        $ovl = $('#edit_salary_dia');
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async: false,
            width: 'auto',
            resizable:false,
            position:'absolute',
             
            modal: true,
            title: title,
            
            /*show:{
                effect:"explode",//effect:"blind",
		duration:200
	    },
            hide:{
		effect:"explode",
		duration:200
	    }*/
        }).parent('.ui-dialog').css('zIndex',1030);
        $ovl.html(d);
        $ovl.dialog("open");
        $('#edit_salary_edit').click(function () {
            Salary.BtnEdit($ovl);
        });
        $('#edit_delete').click(function () {
            Salary.Delete($ovl);
        });
        $('#edit_close').click(function () {
            $ovl.dialog("close");
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
                dict.push(json_obj[i].member_login_name);
                }
                  //var dict = ["Test User02","Adminstrator"];
                loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                       //alert(dict);                    
             $('.username').autocomplete({
                        source: function( request, response ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( dict, function( item ){                 
                        return matcher.test( item);
                         }) );
                 },
                        minLength :1
                 });
       // ... do whatever you need to do with icon here
   } 
       },
    getmemid: function (name){                       
        //var name = document.getElementById('namelist').value;
           // alert("aaa");
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
         var dict = [];
       $.ajax({
                url:'getmemberid?uname='+name,
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                    //alert(json_obj[i].member_id);
               // var aa = json_obj[i].member_id;
                //alert(aa);
                //$('#formemberid').text(json_obj[i].member_id);
               // $(".salusername").text(aa);
                dict.push(json_obj[i].member_id);
                }
                  //var dict = ["Test User02","Adminstrator"];
                  //alert(dict);
                 loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                      // alert(dict);
                        $('#formemberid').val(dict);
                     }
                     
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
    },
    Delete : function(d){
         $del = $('#confirm');
        $del.css('color','black');
        $del.css('background','#F5F5F5');
          $del.dialog({
            autoOpen:false,
            height:'auto',
            width:'auto',
            resizable: false,
            closeText:'',
            modal:true,
            title:"Confirm Delete",
            buttons:{
                Yes:function(){
                    Salary.Confirm(d);
                },
                No:function(){
                    $(this).dialog("close");
                }
            }
           
        }).parent('.ui-dialog').css('zIndex',9999);
         $del.html("<p>Are u sure to delete?</p>");
        $del.dialog("open");  
    },
    Confirm :function(d){
        var form=$('#edit_salary');
        var member_id=document.getElementById('member_id').value;
        $.ajax({
            type:'POST',
            url : baseUri+"salary/index/delete_salary",
            data: {id: member_id },
            success:function(){
                
                d.dialog("close");
            }
        }).done(function(){
            //$('body').load('salarylist');
            location.reload();
        });
    },
    calSalary : function (){
        //alert("add");
        
        $.ajax({            
           url:"calSalary",
           type: "GET",
           dataType : "json",
           success:function(d){               
                var data ='<form id="Add_new_deduct"><table>'; 
                    data += '<tr><td>'+d.cal_text+'<br></td></tr>'
                    +'<tr><td><div style="display:none;" id="error_salary">Please Choose Pay Month!</div><div style="display:none;" id="nexterror_salary">Please choose another pay Month!</div></td></tr>'        
                       +'<tr><td><input type="text" class="datepicker"  placeholder="'+d.cal_placehd+'" style="height:39px; width: 100%;" id="salary_start"></td></tr>'        
                    data +='<tr><td><a href="#" class="button" id="cal_salary_month">'+d.cal_yes+'</a><a href="#" class="button" id="cancel_deduct">'+d.cal_no+'</a></td></tr>';
                    data +='</table></form>';
               Salary.Diaaadd(data,d.cal_title);
           }
        });
        },
        Diaaadd : function (d,title){
        if(!this.isOvl){
            this.isOvl=true;
        }
        
        $ovl = $('#add_new_dt');
        $ovl.dialog({
            autoOpen: false,
            height: 'auto',
            async:false,     
            resizable:false,
            width: 'auto',
            modal: true,
            title:title
        });                        
        $ovl.html(d);
        $ovl.dialog("open");
        $ovl.css('color','black');
        $ovl.css('background','#F5F5F5');
        $('#cal_salary_month').click(function(){
            var salary_start = document.getElementById('salary_start').value;                     
                    if(salary_start == ''){
                        $('#error_salary').show();
                    }else{
                       Salary.SaveSalary(salary_start);
                    }    
        });  
          
        $('#cancel_deduct').click(function(){
           $ovl.dialog("close");
           location.reload();

        });
        $('.datepicker').on('click',function(e){
             e.preventDefault();                                                    
             $(this).removeClass('datepicker').datepicker( { dateFormat:"yy-mm-dd",                                                                                           
             }).focus();                               
        });
    },
    
    autolist: function (){                       
        //var name = document.getElementById('namelist').value;
          //  alert("aaa");
        //url = baseUri + 'attendancelist/index/'+link+'?namelist='+name;
         var dict = [];
       $.ajax({
                url:'autolist',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
               
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                   // alert(json_obj[i].full_name);
                dict.push(json_obj[i].member_login_name);
                }
                  //var dict = ["Test User02","Adminstrator"];
                loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                       //alert(dict);
                      $('.tags').autocomplete({
                        source: function( request, response ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                        response( $.grep( dict, function( item ){                 
                        return matcher.test( item);
                         }) );
                 },
                        minLength :1
                 });
       // ... do whatever you need to do with icon here
   }
    
       },
       //searcch salary list by travel fees and user name
       search_salarylist: function (){
           var $form = $('#frm_search').serialize();
           $.ajax({
                url:baseUri + 'salary/search/searchTravelfees?' + $form,
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
               var json_obj = $.parseJSON(data);//parse JSON 
               $('table.listtbl tbody').empty(),$('tfoot').empty(),$('div #content').empty(),$('#th_travelfees').empty();
               
               var j=1;
               var travelfees;
               var travelfee_header;
                    for (var i in json_obj)
                    { 
                        if(json_obj[i].travel_fee_perday)
                        {
                           var travelfees=json_obj[i].travel_fee_perday;
                           var travelfee_header='Travel fees (per day)';
                        }
                        else{
                            var travelfees=json_obj[i].travel_fee_permonth;
                            var travelfee_header='Travel fees (per month)';
                        }
                        var output = "<tr>"
                                + "<td>" +j+ "</td>"
                                + "<td>" + json_obj[i].member_login_name + "</td>"
                                + "<td>" + json_obj[i].basic_salary + " </td>"
                                + "<td>" + travelfees + "</td>"
                                + "<td>" + json_obj[i].over_time + "</td>"
                                + "<td>" + json_obj[i].ssc_emp + "</td>"
                                + "<td>" + json_obj[i].ssc_comp + "</td>"
                                + "<td><a href='#' onclick='return false;' style='float:right;margin-top: 5px;' class='inedit displaypopup' id='"+json_obj[i].member_id+"'></a></td>"
                                + "</tr>";
                        $("tbody").append(output);
                        j++;
                    }
                    $("#th_travelfees").append(travelfee_header);
                    Salary.init();
                 }
                        
                 });
       },
        
    search : function () { 
    var $form = $('#search_frm').serialize();
    var year=document.getElementById('year').value;
    var month=document.getElementById('month').value;
    //window.location.href = baseUri + 'salary/search?'+$form;
    $.ajax({
        url: baseUri + 'salary/search?' + $form,
        type: 'GET',
        success: function (d) {
           $('table.listtbl tbody').empty(),$('tfoot').empty(),$('div #content').empty();
        if (d.length==2) {
            
            var output = "<tr>"
                    + "<td colspan='13'><center>No data to display</center></td>"
                    + "</tr>";
            $("tbody").append(output);
        }
        else{
             var json_obj = $.parseJSON(d);//parse JSON            
           
            var totalsal = 0;
            for (var i in json_obj)
            {   
                var aa = parseInt(json_obj[i].total);
                totalsal =totalsal + aa ;
                var formatter = new Intl.NumberFormat(); //Create our number formatter.
                 
                    var output = "<tr>"
                        + "<td><input type='checkbox' class='case' name='chk[]' value="+json_obj[i].member_id+" ></td>"
                        + "<td>" + json_obj[i].full_name + "</td>"
                        + "<td>" + json_obj[i].member_dept_name + "</td>"
                        + "<td>" + json_obj[i].position + "</td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].basic_salary)+ "</div></td>"
                        + "<td><div class='td-style'>" + json_obj[i].overtime + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].travel_fee) + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].allowance_amount) + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].absent_dedution) + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].income_tax) + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].ssc_comp) + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].ssc_emp) + "</div></td>"
                        + "<td><div class='td-style'>" + formatter.format(json_obj[i].total) + "</div></td>"
                        + '<td><a href="#" class="btn_detail" title="Detail" id="detail_img" style="margin-top: 13px;"></a></a></td>'
                     
                        
                $("tbody").append(output);
                
                
            }
       
          
            var html='<tr>'
                        +'<td colspan="12" style="text-align:center;background-color:#3c8dbc; color:#ffffff;"><b>Total salary for all user</b></td>'
                        +'<td style ="background-color:#3c8dbc; color:#ffffff;"><div class="td-style"> '+formatter.format(totalsal)+'</div></td>'
                        +'<td style ="background-color:#3c8dbc; color:#ffffff;"></td>'
                        +'</tr>'
            $("tbody").append(html);}
            Salary.init();
            //click event for detail after search
            $('.btn_detail').click(function () {
            var month = document.getElementById('month').value;
            var year = document.getElementById('year').value;
            var chkbox = document.getElementsByName('chk[]');
            var chk = [];
            for (var i=0, n=chkbox .length;i<n;i++) {
            if (chkbox [i].checked) 
            {
            chk.push(chkbox[i].value);
            }
       
            }
            if(chk!=""){
            window.location.href = baseUri + 'salary/index/salarydetail?chk_val='+chk+'&month='+month+'&year='+year;
            }
            else{
            alert("please check aleast one!");
            location.reload();
            }
         //window.location.href = baseUri + 'salary/index/salarydetail?chk_val='+chk+'&month='+month+'&year='+year;

            });
        },
        error: function (d) {
            alert('error');
        }
        
        });
         
        },
        SaveSalary: function (d){ 
           // alert(d);
           var date = d;
                $.ajax({
                         url:'checkmonthyear',
                         method: 'GET',
                         data : {monthyear : d},
                        // dataType: 'json',
                         success: function(d) {
                            // alert(d);
                             data= JSON.parse(d);
                             if(data==='found'){
                                // alert("Found!");
                                 $('#error_salary').hide();
                              $('#nexterror_salary').show();
                               //window.location.href=baseUri+'salary/calculate?salary_date='+d;
                             }
                             else{
                                 window.location.href=baseUri+'salary/calculate?salary_date='+date;
                             }                           
                                 }
                                 
                             });  
                 
                 }
        
};

$(document).ready(function () {
    Salary.init();
    var popupStatus = 0;
    $('#search_salary').click(function () { 
        Salary.search();
    });
    $("body").on("click",".displaypopup",function () {
        var id = $(this).attr('id');
        Salary.Edit(id);
    });
    //for auto complete into user name textbox
    $(".username").click(function(){
		Salary.salnameautolist();
               
	});
    
//isplay popup to calculate monthly salary
    $("#displaypopup").click(function(){
        Salary.calSalary();
               
	});
    $('#cal_salary').click(function () {
        Salary.search();
    });
    $('.tags').click(function () {
        Salary.autolist();
    });
    $("#search_salary").mouseenter(function(){
       var name = document.getElementById('namelist').value;
		Salary.getmemid(name);      
	});
    $(".search-trtype").click(function(){
	Salary.search_salarylist();       
	});
    //get member_id 
    $("#username").blur(function(){
        
       var name = document.getElementById('username').value;
       //alert(name);
		Salary.getmemid(name);
               
	});
   
    
});



