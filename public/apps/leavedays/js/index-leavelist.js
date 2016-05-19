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
      search_list();        
};          
Leave.ExportAll = function () {
       var lt = $('#ltype').val(),
                mm = $('#month').val(),
                name = $('#namelist').val();

        if ("" === lt && "" === mm && ("" === name || !isValid(name))) {
            location.href = "leavelist/1";
        }
        else {
            location.href =  baseUri + 'leavedays/search/index/1?ltype='+lt+'&month='+mm+'&namelist='+name+'&page=0';
        }
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
    
    $('.leavelist-export').click(function(e){
           if($('.pagination li').length == 0){            
            Export.Export.apply(this, [$('table.listtbl'), 'Leave_List.csv']);
        }
        else{
            e.preventDefault();
            Leave.ExportAll();
        }
    });
    
});

 
