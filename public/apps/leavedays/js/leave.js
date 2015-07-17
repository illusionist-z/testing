/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 */

$(document).ready(function(){
    var userUri = baseUri + 'leavedays/';
    
    $('#frm_search').submit(function(){
    var month = document.getElementById('month').value;
    alert(month);
    $.ajax({
    type: "POST",
    url: "bin/process.php",
    data: dataString,
    success: function() {
      alert("AAA");
    }
  });
                    });
    });
