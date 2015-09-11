/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @GEOprocess()
 * @get @lat @lng
 //for pagination
/*
 * show monthly list by return json array
 * @author Su ZIn Kyaw
 */

$(document).ready(function () { 

    // ユーザーのクリックした時の動作。    

         
    
    $('#search').click(function () {
       
        search();
    });
             
});



var search = function () {
    var month = document.getElementById('month').value;
    
     window.location.href = baseUri + 'attendancelist/user/attendancelist?month='+month;
    
};
