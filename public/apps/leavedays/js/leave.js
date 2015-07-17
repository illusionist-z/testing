/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */

$(document).ready(function () {
    var userUri = baseUri + 'leavedays/';

    $('#frm_search').submit(function () {
        search();
    });
});


function search()
{
    var leave_type = document.getElementById('ltype').value;
    var month = document.getElementById('month').value;
    var namelist = document.getElementById('namelist').value;
    //window.location.href = baseUri + 'leavedays/search?ltype='+leave_type+'&month='+month+'&namelist='+namelist;
//  var $form = $('#frm_search');
    $.ajax({
        url: baseUri + 'leavedays/search?ltype=' + leave_type + '&month=' + month + '&namelist=' + namelist,
        type: 'GET',
        success: function (d) {
            alert("success");
           var myJsonString = JSON.stringify(d);
//            
             $("#content").html(d);
            
        },
        error: function (d) {
            alert('error');
        }
    });
}
