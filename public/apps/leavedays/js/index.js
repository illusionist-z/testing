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
    
     
    //set slide menu
 
    // ここに実際の処理を記述します。
   
    
    var search=function(){
       var month = document.getElementById('month').value; 
        var ltype = document.getElementById('ltype').value;  
    
         window.location.href = baseUri + 'leavedays/user/leavelist?month='+month+'?ltype='+ltype;
    };
    
    

    
    $('#usersearch').click(function(){
       
        search();
    });
    
     
});
