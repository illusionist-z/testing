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
      
         window.location.href = baseUri + 'attendancelist/user/attendancelist?month='+month;
    };
    
     var sub=function(){
       var month = document.getElementById('month').value;  
       var username = document.getElementById('username').value; 
       var year = document.getElementById('year').value; 
         window.location.href = baseUri + 'attendancelist/index/monthlylist?month='+month+'?username='+username+'?year=' +year;
    };
    
     var namesearch=function(){
       var namelist = document.getElementById('namelist').value;  
      
         window.location.href = baseUri + 'attendancelist/index/todaylist?namelist='+namelist;
    };
    // ユーザーのクリックした時の動作。

    
    $('#search').click(function(){
        search();
    });
    
      $('#sub').click(function(){
          alert("sub");
        sub();
    });
    
     $('#namesearch').click(function(){
        namesearch();
    });
});
