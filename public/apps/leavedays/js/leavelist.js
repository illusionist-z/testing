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

var User = {       
        userautolist: function (){                       
        
         var dict = [];
       $.ajax({
                url:'leaveuserautolist',
                method: 'GET',
                //dataType: 'json',
                success: function(data) {
                //alert(data);    
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                   // alert(json_obj[i].full_name);
                dict.push(json_obj[i].full_name);
                }
                  //var dict = ["Test User02","Adminstrator"];
                loadIcon(dict);
                        }
                        
                    });
                     function loadIcon(dict) {
                       //alert(dict);
                        $('.userauto').autocomplete({
              source: dict
            });
      
                } 
       }
};
            
    
$(document).ready(function(){        
    //intialize paging
    Leave.init();
    
    var userUri = baseUri + 'leavedays/';    
    
    $('#search').click(function () {        
        Leave.List();
    }); 
     $('.userauto').click(function () {
        //alert("aaa");
        User.userautolist();
    }); 
    
});

 
