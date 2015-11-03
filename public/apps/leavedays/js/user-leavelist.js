/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var pager = new Paging.Pager(),User={};   //for pagination

/*
 * show today list by return json array
 * @version 10/9/2015 David
 */
   User.LeaveList = {
        init : function (){
            $('tfoot').html($('tbody').html());   //for csv
            pager.perpage =7;            
            pager.para = $('tbody > tr');
            pager.showPage(1);  
            $('tbody').show();
        },
        search : function(){
            var month = document.getElementById('month').value; 
            var ltype = document.getElementById('ltype').value;  
            window.location.href = baseUri + 'leavedays/user/leavelist?month='+month+'&ltype='+ltype;
        }
    };
$(document).ready(function(){
//set slide menu
 
    // ここに実際の処理を記述します。
    User.LeaveList.init();
    
    $('#usersearch').click(function(){
          User.LeaveList.search();
    });
    
     
});

