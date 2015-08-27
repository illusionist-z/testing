/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * @version 24/8/2015 David
 * @LeaveList
 */

this.pager = new Paging.Pager();

this.init =  function(){
           $("tfoot").html($('tbody').html()); //for csv           
            pager.perpage =3;            
            pager.para = $('tbody > tr');
            pager.showPage(1);  
     };


$(document).ready(function(){        
    //intialize paging
    init();
    
    var userUri = baseUri + 'leavedays/';    
    
    $('#search').click(function () {  
        Leave.Search();
    });      
});

 
