
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
        for (var i = 0, n = chkbox.length; i < n; i++) {
            if (chkbox [i].checked)
            {
                chk.push(chkbox[i].value);
            }
        }
        if (chk != "") {
            window.location.href = baseUri + 'salary/index/printsalary?chk_val=' + chk + '&month=' + month + '&year=' + year;
        }
        if (chk == "" || chk == "on") {
            alert("please check aleast one!");
            location.reload();
        }

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
        for (var i = 0, n = chkbox.length; i < n; i++) {
            if (chkbox [i].checked)
            {
                chk.push(chkbox[i].value);
            }
        }

        window.location.href = baseUri + 'salary/index/printtaxform?chk_val=' + chk + '&month=' + month + '&year=' + year;
//         $.ajax({
//             url: baseUri + 'salary/index/printsalary',
//             type: 'get',
//             data : {chk_val:chk},
//
//         });
    });


//    $('#clicktd').click(function () {
//       $("#getcheck").prop("checked", true);
//    var check = document.getElementById('clicktd').value;
//      for (var i = 0; i < check.length; i++) {          
//                    $("#getcheck").prop("checked", true);       
//        }
//    });

    $('#btn_tax').click(function () {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var chkbox = document.getElementsByName('chk[]');
        var chk = [];
        for (var i = 0, n = chkbox.length; i < n; i++) {
            if (chkbox [i].checked)
            {
                chk.push(chkbox[i].value);
            }
        }

        window.location.href = baseUri + 'salary/index/printtax?chk_val=' + chk + '&month=' + month + '&year=' + year;

    });

    //click the detail button for detail of salary
    $('.btn_detail').click(function () {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var chk= document.getElementById('getcheck').value;

//        var chk = [];

//        for (var i = 0, n = chkbox.length; i < n; i++) {
//            if (chkbox [i].checked)
//            {
//                chk.push(chkbox[i].value);
//            }
//
//        }
//
//        if (chk != "") {
            window.location.href = baseUri + 'salary/index/salarydetail?chk_val=' + chk + '&month=' + month + '&year=' + year;
//        }
//        if (chk == "" || chk == "on") {
//            alert("please check aleast one!");
//            location.reload();
//        }
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
    
    
    function rowClick(e) {
        // discard direct clicks on input elements
        if (e.target.nodeName === "INPUT") return;
        // get the first checkbox
        var checkbox = this.querySelector("input[type='checkbox']");
        if (checkbox) {
            // if it exists, toggle the checked property
            checkbox.checked = !checkbox.checked;
        }
    }
    // iterate through all rows and bind the event listener
    [].forEach.call(document.querySelectorAll("tr"), function (tr) {
        tr.addEventListener("click", rowClick);
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





