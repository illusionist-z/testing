/** 
 * @author David<david.gnext@gmail.com>
 * @version 24/8/2015 David
 * @LeaveList
 */

this.pager = new Paging.Pager();
var Leave = {};

Leave.init =  function(){
           $("tfoot").html($('tbody').html()); //for csv           
            pager.perpage =7;            
            pager.para = $('tbody > tr');
            pager.showPage(1);
            $("tbody").show();
     };
Leave.List = function () {
           search_list();  
};

$(document).ready(function(){        
    //intialize paging
    Leave.init();
    
    var userUri = baseUri + 'leavedays/';    
    
    $('#search').click(function () {        
        Leave.List();
    });      
});

 
