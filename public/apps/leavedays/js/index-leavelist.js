/** 
 * @author David<david.gnext@gmail.com>
 * @version 24/8/2015 David
 * @LeaveList
 */

var Leave = {},dict=[];

Leave.init =  function(reload){
      $('.listtbl tbody').has("tr").length > 0 ? null : MsgDisplay();
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
                      dict.push(json_obj[i].member_login_name);
                      }                  
                }
                        
                });
            }
     };
Leave.List = function () {
    Leave.init();
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
                        source: function( request, response ) {                                       
                            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" ); 
                            var result = $.grep( dict, function( item ){                 
                                       return matcher.test( item);
                                      });
                                response(result.slice(0, 10));
                         },
                          minLength :1
                });
    }); 
    
});

 
