/** 
 * @author David<david.gnext@gmail.com>
 * @version 24/8/2015 David
 * @LeaveList
 */

this.pager = new Paging.Pager();
var Leave = {},dict=[];

Leave.init =  function(reload){
           $("tfoot").html($('tbody').html()); //for csv           
            pager.perpage =7;            
            pager.para = $('tbody > tr');
            pager.showPage(1);
            $("tbody").show();
            if(reload){
              $.ajax({
                url:'autolist',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                   // alert(json_obj[i].full_name);
                      dict.push(json_obj[i].full_name);
                      }                  
                }
                        
                });
            }
     };
Leave.List = function () {
           search_list();  
};          
    
$(document).ready(function(){     
    //intialize paging
    Leave.init('reload');
    
    var userUri = baseUri + 'leavedays/';    
    
    $('#search').on('click',function(){     
        Leave.List();
    }); 
   $('.userauto').on('click',function(){
        $(this).autocomplete({
            source : dict
        });
    }); 
    
});

 
