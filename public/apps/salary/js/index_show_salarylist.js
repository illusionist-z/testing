
/**
 * @author zinmon
 * @desc   Salary Edit Dial Box
 */
$(function () {
    $('#btn_print_salary').click(function () {
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
         window.location.href = baseUri + 'salary/index/printsalary?chk_val='+chk+'&month='+month+'&year='+year;
//         $.ajax({
//             url: baseUri + 'salary/index/printsalary',
//             type: 'get',
//             data : {chk_val:chk},
//
//         });
     });
     
     
     
    $('#btn_tax_form').click(function () {  
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
    
         window.location.href = baseUri + 'salary/index/printtaxform?chk_val='+chk+'&month='+month+'&year='+year;
//         $.ajax({
//             url: baseUri + 'salary/index/printsalary',
//             type: 'get',
//             data : {chk_val:chk},
//
//         });
     });
     $('#btn_tax').click(function () {  
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
    
         window.location.href = baseUri + 'salary/index/printtax?chk_val='+chk+'&month='+month+'&year='+year;

     });
     
     //click the detail button for detail of salary
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
//         $.ajax({
//             url: baseUri + 'salary/index/salarydetail',
//             type: 'get',
//             data : {chk_val:chk},
////             success: function (data) {
////                 alert("success");
////             }
//         });
     });
 });
function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }

 
 


