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
  
    $('#userlistsearch').click(function(){
       
        search();
    });
    
     
});

 var search=function(){
     
       var username = document.getElementById('username').value; 
       
       
         window.location.href = baseUri + 'manageuser/user/userlist?username='+username;
    };
